<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
"use strict";
;(function($, window, document) {
    $(document).ready(function(){
		// Check if customer exist
		var customer = {{ $customer ? 'true' : 'undefined'}};

		var selected_address = $('input[type="radio"].ship-to-address:checked');
		if(selected_address.val()){
			checkShippingZone(selected_address.data('country'));
		}

		// Disable checkout if seller has no payment option
		if ($('.payment-option').length == 0) {
			disableCartCheckout('{{ trans('theme.notify.seller_has_no_payment_method') }}');
			$('#payment-instructions').children('span').html('{{ trans('theme.notify.seller_has_no_payment_method') }}');
		}

		// Show email/password form is customer want to save the card/create account
		if ($("#create-account-checkbox, #remember-the-card").is(':checked'))
			showAccountForm();

	    // Toggle account creation fields
	    $('#create-account-checkbox, #remember-the-card').on('ifChecked', function() {
	    	$('#create-account-checkbox').iCheck('check');
			showAccountForm();
	    });
	    $('#create-account-checkbox').on('ifUnchecked', function() {
	    	$('#remember-the-card').iCheck('uncheck');
	        $('#create-account').hide().find('input[type=email],input[type=password]').removeAttr('required');
	    });

	    $('.payment-option').on('ifChecked', function(e) {
	    	var code = $(this).data('code');
			$("#payment-instructions.text-danger").removeClass('text-danger').addClass('text-info small');
			$('#payment-instructions').children('span').html($(this).data('info'));

	    	// Alter checkout button text Stripe
			if ('stripe' == code)
				showCardForm();
	    	else
	    		hideCardForm();

	    	// Alter checkout button text Authorize Net
			if ('authorize-net' == code)
				showAuthorizeNetCardForm();
	    	else
	    		hideAuthorizeNetCardForm();

	    	// Alter checkout button
			if ('paypal-express' == code){
	            $('#paypal-express-btn').removeClass('hide');
	            $('#pay-now-btn').addClass('hide');
			}
			else{
	            $('#paypal-express-btn').addClass('hide');
	            $('#pay-now-btn').removeClass('hide');
			}
	    });

		// Alter shipping address
		$('.customer-address-list .address-list-item').on('click', function(){
			var radio = $(this).find('input[type="radio"].ship-to-address');
			$('.address-list-item').removeClass('selected has-error');
			$(this).addClass('selected');
			radio.prop("checked", true);
			$('#ship-to-error-block').text('');

			checkShippingZone(radio.data('country'));
		});

		// Show shipping charge may change msg if zone changes
		$("select[name='country_id']").on('change', function(){
			$(this).next('.help-block').html('<small>{{ trans('theme.notify.shipping_cost_may_change') }}</small>');
			checkShippingZone($(this).val());
	    });

		// Submit the form
		$("a#paypal-express-btn").on('click', function(e) {
	      	e.preventDefault();
			$("form#checkoutForm").submit();
		});

		// Show cart form if the card option is selected
		var paymentOptionSelected = $('input[name="payment_method"]:checked');
		if ( paymentOptionSelected.length > 0) {
			if( paymentOptionSelected.data('code') == 'stripe' )
				showCardForm();
			if( paymentOptionSelected.data('code') == 'authorize-net' )
				showAuthorizeNetCardForm();
		}

	    // Stripe code, create a token
	    Stripe.setPublishableKey("{{ config('services.stripe.key') }}");

		$("form#checkoutForm").on('submit', function(e){
	      	e.preventDefault();

			var form = $(this);

			// Check if payment method has been selected or not
		  	if ( ! $("input:radio[name='payment_method']").is(":checked") ) {
				$("#payment-instructions.text-info").removeClass('text-info small').addClass('text-danger');
				return;
		  	}

			// If customer exist the check shipping address is seleced
			if (typeof customer !== "undefined") {
				if ( ! $("input:radio[name='ship_to']").is(":checked") ){
					$('.address-list-item').addClass('has-error');
					$('#ship-to-error-block').html("{{trans('theme.notify.select_shipping_address')}}");
					return;
				}
			}

			// Check if form validation pass
			if ($(".has-error").length){
	            @include('layouts.notification', ['message' => trans('theme.notify.fill_required_info'), 'type' => 'warning', 'icon' => 'times-circle'])
				return;
			}

			apply_busy_filter('body');

		  	// Skip the strip payment and submit if the payment method is not stripe
		  	if ( $('input[name=payment_method]:checked').data('code') !== 'stripe' )
				form.get(0).submit();

			// Stripe API skip the request if the information are not there
			if (!$("input[data-stripe='number']").val() || !$("input[data-stripe='cvc']").val())
				return;

		    Stripe.card.createToken(form, function(status, response) {
		        if (response.error) {
		          	form.find('.stripe-errors').text(response.error.message).removeClass('hide');
					remove_busy_filter('body');
		        } else {
		          	form.append($('<input type="hidden" name="cc_token">').val(response.id));
		          	form.get(0).submit();
		        }
			});
	    });

		$("#submit-btn-block").show(); // Show the submit buttons after loading the doms
    });

	// Functions
    function checkShippingZone(countryId)
    {
        var shop = '{{ $cart->shop_id }}';
        // var countryId = $(this).val();
	    var zone = getFromPHPHelper('get_shipping_zone_of', [shop, countryId]);
		zone = JSON.parse(zone);

		if($.isEmptyObject(zone)) {
			if($("#createAddressModal").is(':visible')){ //If the form in the address create modal
				$("#createAddressModal").find("select[name='country_id']").next('.help-block').html('<small>{{ trans('theme.notify.seller_doesnt_ship') }}</small>');
			}
			else {
				@include('layouts.notification', ['message' => trans('theme.notify.seller_doesnt_ship'), 'type' => 'warning', 'icon' => 'times-circle'])
			  	disableCartCheckout("{{ trans('theme.notify.seller_doesnt_ship') }}")
			}
		}
		else {
		  	enableCartCheckout()
		}
    }

    function showAccountForm()
    {
        $('#create-account').show().find('input[type=email],input[type=password]').attr('required', 'required');
    }

    // Stripe
    function showCardForm()
    {
		$('#cc-form').show().find('input, select').attr('required', 'required');
		$('#pay-now-btn-txt').html('{!!trans('theme.button.pay_now') . ' <small>(' . get_formated_currency($cart->grand_total(), 2) . ')</small>'!!}');
    }

    function hideCardForm()
    {
		$('#cc-form').hide().find('input, select').removeAttr('required');
		$('#pay-now-btn-txt').text('{{trans('theme.button.checkout')}}');
    }

    // Authorize Net
    function showAuthorizeNetCardForm()
    {
		$('#authorize-net-cc-form').show().find('input, select').attr('required', 'required');
		$('#pay-now-btn-txt').html('{!!trans('theme.button.pay_now') . ' <small>(' . get_formated_currency($cart->grand_total(), 2) . ')</small>'!!}');
    }
    function hideAuthorizeNetCardForm()
    {
		$('#authorize-net-cc-form').hide().find('input, select').removeAttr('required');
		$('#pay-now-btn-txt').text('{{trans('theme.button.checkout')}}');
    }

  	function disableCartCheckout(msg = '')
  	{
		$('#checkout-notice-msg').html(msg);
		$("#checkout-notice").show();
        $('#pay-now-btn, #paypal-express-btn').hide();
  	}

  	function enableCartCheckout()
  	{
		$("#checkout-notice").hide();
        $('#pay-now-btn, #paypal-express-btn').show();
  	}
}(window.jQuery, window, document));
</script>