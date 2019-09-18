<script type="text/javascript">
"use strict";
;(function($, window, document) {
    $(document).ready(function(){
    	// Check if specific cart is given
    	var expressId = '{{ $expressId }}';
    	if( '' != expressId){
			apply_busy_filter('body');
    		$('#cartId'+expressId)[0].scrollIntoView({ behavior: 'smooth', block: 'start', offsetTop: 50}); // Scroll screen to target element
    	}

    	$('.shopping-cart-table-wrap').each(function(e){
			var cart = $(this).data('cart');
	        var shop = $('#shop-id'+cart).val();
			// var shippingOptions = $("#shipping-options"+cart).data('options');
			var shippingOptions = getShippingOptions(cart);

			if( ! shop || ! shippingOptions ){
				disableCartCheckout(cart);
			}
			else{
				var shippingRateId = Number($('#shipping-rate-id'+cart).val());
				var shippingRate = $.grep(shippingOptions, function(el){
					return el.id === shippingRateId;
				})[0];

				if (shippingRate)
		            setShippingCost(cart, shippingRate.name, shippingRate.rate, shippingRate.id);
				else
					setShippingOptions(cart);
			}
    	});

        // Update shipping options
        $(".ship_to").on('change', function(e) {
	        var cart = $(this).data('cart');
	        var shop = $('#shop-id'+cart).val();
	        var countryId = $(this).val();

		    var zone = getFromPHPHelper('get_shipping_zone_of', [shop, countryId]);
			zone = JSON.parse(zone);

			if($.isEmptyObject(zone)){
	            @include('layouts.notification', ['message' => trans('theme.notify.seller_doesnt_ship'), 'type' => 'warning', 'icon' => 'times-circle'])
			}

			$("#zone-id"+cart).val(zone.id);
			$("#tax-id"+cart).val(zone.tax_id);

		    var options = getFromPHPHelper('getShippingRates', [zone.id]);
			$("#shipping-options"+cart).data('options', JSON.parse(options));

			// Set shipping options for the zone
			setShippingOptions(cart);

			// Remove the discount if the zone changes as discount can be depends on zone
			resetDiscount(cart);
    	});

        // Update Item total on qty change
        $(".product-info-qty-input").on('change', function(e) {
	        var cart = $(this).data('cart');
	        var item = $(this).data('item');
	        var qtt = $(this).val();
			var unitWeight = Number($("#unitWeight"+item).val());

			// Set Item Price
        	var total = $('#item-price'+cart+'-'+item).data('value') * qtt;
			$('#item-total'+cart+'-'+item).text(getFormatedValue(total));

			// Set Item Weight
			var itemWeight = unitWeight * qtt;
			$("#itemWeight"+item).val(itemWeight);

			calculateCartTotal(cart);

			// Set shipping options for the zone
			setShippingOptions(cart);

			// Reset discount
			resetDiscount(cart);
    	});

    	// Item remove from the cart
    	$('.cart-item-remove').on('click', function(e){
            e.preventDefault();
            var node = $(this);
	        var cart = $(this).data('cart');
	        var item = $(this).data('item');

			$.ajax({
			    url: '{{ route('cart.removeItem') }}',
			    type: 'POST',
			    data: {'cart':cart,'item':item},
			    dataType: 'JSON',
			    complete: function (xhr, textStatus) {
			    	if(200 == xhr.status){
		                @include('layouts.notification', ['message' => trans('theme.notify.item_removed_from_cart'), 'type' => 'success', 'icon' => 'check-circle'])

			    		node.parents('tr.cart-item-tr').remove();

			    		// Remove the cart if it has no items
			    		if($('#table'+cart+' tbody').children().length == 0){
							$('#cartId'+cart).remove();
			    		}
			    		else{
							// Set shipping options for the zone
							setShippingOptions(cart);

							calculateCartTotal(cart);
			    		}

			    		// Decrease global cart item count by 1
			    		decreaseCartItem(1);
			    	}
			    	else{
		                @include('layouts.notification', ['message' => trans('theme.notify.failed'), 'type' => 'warning', 'icon' => 'times-circle'])
			    	}
			    },
			});
    	});

    	// Coupon
    	$('.apply_seller_coupon').on('click', function(e){
            e.preventDefault();
	        var cart = $(this).data('cart');
	        var coupon = $('#coupon'+cart).val();
	        var shop = $('#shop-id'+cart).val();
	        var zone = $('#zone-id'+cart).val();
			coupon = coupon.trim();

	        if(coupon){
				$.ajax({
				    url: '{{ route('validate.coupon') }}',
				    type: 'POST',
				    data: {'coupon':coupon,'shop':shop,'cart':cart,'zone':zone},
				    dataType: 'JSON',
				    success: function (data, textStatus, xhr) {
				    	if(200 == xhr.status){
							if(data.min_order_amount && totalPrice < data.min_order_amount){
				                @include('layouts.notification', ['message' => trans('theme.notify.coupon_min_order_value'), 'type' => 'danger', 'icon' => 'times-circle'])
								resetDiscount(cart);
							}
							else{
					    		setDiscount(cart, data);
			                    @include('layouts.notification', ['message' => trans('theme.notify.coupon_applied'), 'type' => 'success', 'icon' => 'check-circle'])
							}
				    	}
				    }
				})
				.fail(function(response) {
			        if (401 === response.status){
						$('#loginModal').modal('show');
			        }
			        else if (500 === response.status){
				        // console.log(response);
			        }
			        else if (403 === response.status){
	                    @include('layouts.notification', ['message' => trans('theme.notify.coupon_not_valid'), 'type' => 'warning', 'icon' => 'times-circle'])
			        }
			        else if (404 === response.status){
	                    @include('layouts.notification', ['message' => trans('theme.notify.coupon_not_exist'), 'type' => 'danger', 'icon' => 'times-circle'])
			        }
			        else if (443 === response.status){
	                    @include('layouts.notification', ['message' => trans('theme.notify.coupon_not_valid_for_zone'), 'type' => 'warning', 'icon' => 'times-circle'])
			        }
			        else if (444 === response.status){
	                    @include('layouts.notification', ['message' => trans('theme.notify.coupon_limit_expired'), 'type' => 'warning', 'icon' => 'times-circle'])
			        }
			        else{
	                    @include('layouts.notification', ['message' => trans('theme.notify.failed'), 'type' => 'danger', 'icon' => 'times-circle'])
			        }

		    		resetDiscount(cart);
		        });
	        }
    	});

    	// Popover
	  	$('[data-toggle="popover"]').on('click', function(){
	        $('.popover').not(this).popover('hide');
	  	});

      	var apply_btn = '<div class="space5"></div><button class="popover-submit-btn btn btn-black btn-block flat" type="button">{{ trans('theme.button.ok') }}</button>';

      	// Do appropriate actions and Update order detail
      	$(document).on("click", ".popover-submit-btn", function() {
	        var node = $(this).parents('.popover-form');
	        var nodeId = node.attr('id');
	        var cart = node.data('cart');

	        switch(nodeId){
	          	case 'shipping-options-popover':
		            var shipping = node.find('input[name=shipping_option]:checked');
		            var name = shipping.attr('id') == 'custom_shipping' ? '{{ trans('theme.custom_shipping') }}' : shipping.attr('id');
		            var id = shipping.parent('label').attr('id');
		            setShippingCost(cart, name, shipping.val(), id);
		            break;

	          	case 'packaging-options-popover':
		            var packaging = node.find('input[name=packaging_option]:checked');
		            var id = packaging.parent('label').attr('id');
		            setPackagingCost(cart, packaging.attr('id'), packaging.val(), id);
		            break;

	          // case 'discount-options-popover':
	          //   setDiscount(node.find('input#input-discount').val());
	          //   break;
	        }

	        // Hide the popover
	    	$('[data-toggle="popover"]').popover('hide');
      	});

		$('a.packaging-options').popover({
			html: true,
			placement:'bottom',
			content: function(){
				var cart = $(this).data('cart');
				var current = getPackagingName(cart);
				var preChecked = String(current) == String('{{ trans('theme.basic_packaging') }}') ? 'checked' : '';

				var options = '<table class="table table-striped">' +
				'<tr><td><div class="radio"><label id="1"><input type="radio" name="packaging_option" id="{{ trans('theme.basic_packaging') }}" value="'+ getFormatedValue(0) +'" '+ preChecked +'>{{ trans('theme.basic_packaging') }}</label></div></td>' +
				'<td><span>{{ get_formated_currency_symbol() }}'+ getFormatedValue(0) +'</span></td></tr>';

				$(this).data('options').forEach( function (item){
				  	preChecked = String(current) == String(item.name) ? 'checked' : '';

				  	options += '<tr><td><div class="radio"><label id="'+ item.id +'"><input type="radio" name="packaging_option" id="'+ item.name +'" value="'+ getFormatedValue(item.cost) +'" '+ preChecked +'>'+ item.name +'</label></div></td>' +
				  	'<td><span>{{ get_formated_currency_symbol() }}'+ getFormatedValue(item.cost) +'</span></td></tr>';
				});
				options += '</table>';

				return '<div class="popover-form" id="packaging-options-popover" data-cart="'+ cart +'">'+
			        	options + apply_btn +
			        '</div>';
			}
		}).on('mouseenter', function () {
            var _this = this;
            $(this).popover('show');
            $('.popover').on('mouseleave', function () {
                $(_this).popover('hide');
            });
        }).on('mouseleave', function () {
            var _this = this;
            setTimeout(function () {
                if (!$('.popover:hover').length) {
                    $(_this).popover('hide');
                }
            }, 100);
        });

		$('a.dynamic-shipping-rates').popover({
			html: true,
			placement:'bottom',
			content: function(){
				var cart = $(this).data('cart');
				var current = getShippingName(cart);
				var preChecked = String(current) == String('{{ trans('theme.free_shipping') }}') ? 'checked' : '';

				var filtered = getShippingOptions(cart);
				var free_shipping = isFreeShipping(cart);
				var handlingCost = $('#handling-cost'+cart).val();

				if($.isEmptyObject(filtered)){
					var options = '<p class="space10"><span class="space10"></span>{{ trans('theme.seller_doesnt_ship') }}</p>';
				}
				else{
					var options = '<table class="table table-striped" id="checkout-options-table">';

					if(free_shipping){
						options += '<tr><td><div class="radio"><label id="0"><input type="radio" name="shipping_option" id="{{ trans('theme.free_shipping') }}" value="'+ getFormatedValue(0) +'" '+ preChecked +'>{{ trans('theme.free_shipping') }}</label></div></td>' +
						'<td>&nbsp;</td><td>&nbsp;</td>' +
						'<td><span>{{ get_formated_currency_symbol() }}'+ getFormatedValue(0) +'</span></td></tr>';
					}

					filtered.forEach( function (item){
				  		preChecked = String(current) == String(item.name) ? 'checked' : '';
				  		var shippingRate = Number(item.rate) + Number(handlingCost);

				  		options += '<tr><td><div class="radio"><label id="'+ item.id +'"><input type="radio" name="shipping_option" id="'+ item.name +'" value="'+ getFormatedValue(item.rate) +'" '+ preChecked +'>'+ item.name +'</label></div></td>' +
				  		'<td>' + item.carrier.name + '</td>' +
				  		'<td><small class"text-muted">'+ item.delivery_takes +'</small></td>' +
				  		'<td><span>{{ get_formated_currency_symbol() }}'+ getFormatedValue(shippingRate) +'</span></td></tr>';
					});
					options += '</table>';
				}

				return '<div class="popover-form" id="shipping-options-popover" data-cart="'+ cart +'">'+
			        options + apply_btn + '</div>';
			}
		}).on('mouseenter', function () {
            var _this = this;
            $(this).popover('show');
            $('.popover').on('mouseleave', function () {
                $(_this).popover('hide');
            });
        }).on('mouseleave', function () {
            var _this = this;
            setTimeout(function () {
                if (!$('.popover:hover').length) {
                    $(_this).popover('hide');
                }
            }, 100);
        });

	    // Functions
		function isFreeShipping(cart)
		{
			var notFree = $(".freeShipping"+cart).filter(function() {
				return this.value != 1;
			});

			if (notFree.length == 0)
				return true;

			return false;
		}

      	function getShippingOptions(cart)
      	{
			var totalPrice  = getOrderTotal(cart);
			var cartWeight  = getCartWeight(cart);
			var shippingOptions = $("#shipping-options"+cart).data('options');

			if (!shippingOptions || $.isEmptyObject(shippingOptions))
				return shippingOptions;

			var filtered = shippingOptions.filter(function (el) {
			  	var result = el.based_on == 'price' && el.minimum <= totalPrice && (el.maximum >= totalPrice || !el.maximum);

			  	if(cartWeight)
			    	result = result || (el.based_on == 'weight' && el.minimum <= cartWeight && el.maximum >= cartWeight);

			  	return result;
			});

			return filtered;
		}

		function calculateTax(cart)
		{
			var total = getOrderTotal(cart);
			var taxrate = getTaxrate(cart);

			var tax = (total * taxrate)/100;

			if(tax > 0)
				$("#tax-section-li"+cart).show();
			else
				$("#tax-section-li"+cart).hide();

			$('#summary-taxes'+cart).text(getFormatedValue(tax));

			calculateOrderSummary(cart);
			return;
		};

		function calculateCartTotal(cart)
		{
			var total = 0;
	    	$('.item-total'+cart).each(function(){
				total += Number($(this).text());
	    	});

	    	$('#summary-total'+cart).text(getFormatedValue(total));

	        calculateTax(cart);
		}

      	function calculateOrderSummary(cart)
      	{
          	var grand = getTotalAmount(cart) + getTax(cart);
          	$("#summary-grand-total"+cart).text(getFormatedValue(grand));
          	return;
      	}

		function getCartWeight(cart)
		{
	      	var cartWeight = 0;
	        $(".itemWeight"+cart).each(function()
	        	{
	              cartWeight += ($(this).val() * 1);
	            }
	        );

	        return cartWeight;
		}

      	function getTotalAmount(cart)
      	{
	        var total = getOrderTotal(cart);
	        if(!total)
	          return total;

	        var packaging = getPackaging(cart);
	        var shipping  = getShipping(cart);
	        var discount  = getDiscount(cart);

	        return (total + shipping + packaging) - discount;
	    }

      	function getPackagingName(cart)
      	{
      		return $("#summary-packaging-name"+cart).text().trim();
      	};

		function getPackaging(cart)
		{
			return Number($("#summary-packaging"+cart).text());
		};

      	function getShipping(cart)
      	{
          	return Number($("#summary-shipping"+cart).text());
      	};

      	function getShippingName(cart)
      	{
          	return $("#summary-shipping-name"+cart).text().trim();
      	};

		function getTaxId(cart)
		{
			return $("#tax-id"+cart).val();
		};

		function getTaxrate(cart)
		{
			return Number($("#cart-taxrate"+cart).val());
		};

		function getTax(cart)
		{
			return Number($("#summary-taxes"+cart).text());
		};

      	function getDiscount(cart)
      	{
        	return Number($("#summary-discount"+cart).text());
      	}

      	function getOrderTotal(cart)
      	{
          	return Number($("#summary-total"+cart).text());
      	};

      	// Setters
      	function setPackagingCost(cart, name, value = 0, id = '')
      	{
	        value = value ? value : 0;
	        $('#summary-packaging'+cart).text(getFormatedValue(value));
	        $('#summary-packaging-name'+cart).text(name);
	        $('#packaging-id'+cart).val(id);

	        calculateTax(cart);
	        return;
      	}

		function setShippingOptions(cart)
		{
			var filtered = getShippingOptions(cart);

			if( ! $.isEmptyObject(filtered) ){
				filtered.sort(function(a, b){return a.rate - b.rate});

				if(isFreeShipping(cart)) {
		            setShippingCost(cart, '{{ trans('theme.free_shipping') }}', 0, 0);
				}
				else {
		            setShippingCost(cart, filtered[0].name, filtered[0].rate, filtered[0].id);
				}

	            enableCartCheckout(cart);
			}
			else{
	            setShippingCost(cart);
				disableCartCheckout(cart);
			}

    		setTaxes(cart);
		}

		function setShippingCost(cart, name = '', value = 0, id = '')
		{
			var handlingCost = isFreeShipping(cart) && value == 0 ? 0 : $('#handling-cost'+cart).val();
			value = Number(value) + Number(handlingCost);
			$('#summary-shipping'+cart).text(getFormatedValue(value));
			$('#summary-shipping-name'+cart).text(name);
			$('#shipping-rate-id'+cart).val(id);
			calculateTax(cart);
			return;
		}

		function setTaxes(cart)
		{
			var totalPrice  = getOrderTotal(cart);
			var tax_id = getTaxId(cart);

			if( ! tax_id ){
				$('#summary-taxrate'+cart).text(0);
				calculateTax(cart);
				return;
			}

			$.ajax({
				url: "{{ route('ajax.getTaxRate') }}",
			    data: {'ID':tax_id},
				success: function(result){
			    	$('#summary-taxrate'+cart).text(result);
			   	 	$('#cart-taxrate'+cart).val(result);

			    	calculateTax(cart);
				}
			});

			return;
		}

		function setDiscount(cart, coupon = null)
		{
			var value = coupon.value;
			var name = coupon.name;
			var totalPrice  = getOrderTotal(cart);

			if(coupon.min_order_amount && totalPrice < coupon.min_order_amount){
                @include('layouts.notification', ['message' => trans('theme.notify.coupon_min_order_value'), 'type' => 'danger', 'icon' => 'times-circle'])
				resetDiscount(cart);
				return;
			}

			if('percent' == coupon.type){
				value = ( coupon.value * (totalPrice/100) );
			 	name += coupon.name + '(' + getFormatedValue(coupon.value) + '%)';
			}

			if(value > 0)
				$("#discount-section-li"+cart).show();
			else
				$("#discount-section-li"+cart).hide();

			$('#summary-discount'+cart).text(getFormatedValue(value));
			$('#summary-discount-name'+cart).text(name);
			$('#discount-id'+cart).val(coupon.id);
			calculateTax(cart);
			return;
		}

		function resetDiscount(cart)
		{
			$("#discount-section-li"+cart).hide();

			if($('#discount-id'+cart).val()){
				$('#summary-discount'+cart).text(getFormatedValue(0));
				$('#summary-discount-name'+cart).text('');
				$('#discount-id'+cart).val('');
				calculateTax(cart);
			}
			return;
		}

      	function disableCartCheckout(cart)
      	{
      		$('#checkout-btn'+cart).attr("disabled", "disabled");
      		$('#table'+cart+' > tfoot').addClass('hidden');

	        var shop = $('#shop-id'+cart).val();
	        if(!shop){
 	     		$('#store-unavailable-notice'+cart).removeClass('hidden');
 	     		$('#table'+cart+' td, #cart-summary'+cart).addClass('text-disable');
	        }
 	     	else{
 	     		$('#shipping-notice'+cart).removeClass('hidden');
 	     	}
      	}
      	function enableCartCheckout(cart)
      	{
      		$('#checkout-btn'+cart).removeAttr("disabled");
      		$('#table'+cart+' > tfoot').removeClass('hidden');
     		$('#shipping-notice'+cart).addClass('hidden');
      	}

    	// Auto Submit the cart If its express checkout
    	if( '' != expressId)
            $("form#formId"+expressId).submit();
    });
}(window.jQuery, window, document));
</script>