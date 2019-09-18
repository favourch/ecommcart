<script type="text/javascript">
"use strict";

;(function($, window, document) {
    $(document).ready(function(){
        $.ajaxSetup ({
            cache: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        initAppPlugins();

        // Activate the tab if the url has any #hash
        $('.nav a').on('show.bs.tab', function (e) {
            window.location = $(this).attr('href');
        });
        $(function () {
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        });

        // Confirmation for actions
        $('body').on('click', '.confirm', function(e) {
            e.preventDefault();

            var form = this.closest("form");
            var url = $(this).attr("href");

            var msg = $(this).data('confirm');
            if(!msg)
                msg = "{{ trans('theme.notify.are_you_sure') }}";

            $.confirm({
                title: "{{ trans('theme.confirmation') }}",
                content: msg,
                type: 'red',
                icon: 'fa fa-question-circle',
                class: 'flat',
                animation: 'scale',
                closeAnimation: 'scale',
                opacity: 0.5,
                buttons: {
                  'confirm': {
                      text: '{{ trans('theme.button.proceed') }}',
                      keys: ['enter'],
                      btnClass: 'btn-primary flat',
                      action: function () {
                        //Disable mouse pointer events and set wait cursor
                        // $('body').css("pointer-events", "none");
                        $('body').css("cursor", "wait");

                        if (typeof url != 'undefined') {
                            location.href = url;
                        }else if(form != null){
                            form.submit();
                            @include('layouts.notification', ['message' => trans('theme.notify.confirmed'), 'type' => 'success', 'icon' => 'check-circle'])
                        }
                        return true;
                      }
                  },
                  'cancel': {
                      text: '{{ trans('theme.button.cancel') }}',
                      btnClass: 'btn-default flat',
                      action: function () {
                        @include('layouts.notification', ['message' => trans('theme.notify.canceled'), 'type' => 'warning', 'icon' => 'times-circle'])
                      }
                  },
                }
            });
        });

        $("#buy-now-btn").on("click", function(e) {
            apply_busy_filter('body');
        });

        // Item Quick View Modal
        $(".itemQuickView").on("click", function(e) {
            e.preventDefault();
            apply_busy_filter('body');

            var url = $(this).attr('href');
            $.get(url, function(data) {
                remove_busy_filter('body');

                $('#quickViewModal').html(data).modal();

                //Initialize application plugins after ajax load the content
                if (typeof initAppPlugins == 'function') {
                    initAppPlugins();
                }
            });
        });

        // Main slider
        $('#ei-slider').eislideshow({
            animation           : 'center',
            autoplay            : true,
            slideshow_interval  : 5000,
        });

        // On checkout page
        // $('#shipping-address-checkbox').on('ifChecked', function() {
        //     $('#shipping-address').removeClass('hide');
        // });
        // $('#shipping-address-checkbox').on('ifUnchecked', function() {
        //     $('#shipping-address').addClass('hide');
        // });

        // View Switcher
        $("a.viewSwitcher").bind("click", function(e){
            e.preventDefault();
            if($(this).hasClass('btn-default')){
                //Aulter the active button
                $('.viewSwitcher').toggleClass('btn-primary btn-default');

                // Aulter the product widget view
                var product_list = $('.product-list .product');
                product_list.parent().toggleClass('col-md-12 col-md-3');
                product_list.toggleClass('product-list-view product-grid-view');

                // Change the action buttons
                $('.product-actions').toggleClass('btn-group');
                $('.product-actions a.btn-default, .product-actions a.btn-link').toggleClass('btn-sm');
                $('.product-actions a:first-child').toggleClass('btn-link btn-default');
            }
            return false;
        });
        // End View Switcher

        // FEEDBACK SYSTEM
        $('.feedback-stars span.star').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
            $(this).parent().children('span.star').each(function(e){
              if (e < onStar)
                $(this).addClass('rated');
              else
                $(this).removeClass('rated');
            });
        });

        $('.feedback-stars span.star').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var wrapper = $(this).parent();

            // Update the rating value
            wrapper.children('input.rating-value').val(onStar);

            wrapper.children('span.star').each(function(e){
                if (e < onStar){
                    $(this).addClass('rated');
                    $(this).children('i').removeClass('fa-star-o').addClass('fa-star');
                }
                else{
                    $(this).removeClass('rated');
                    $(this).children('i').removeClass('fa-star').addClass('fa-star-o');
                }
            });
            $(this).siblings('span.response').text($(this).data('title'));
        });
        //END FEEDBACK SYSTEM

        // DISPUTE FORM
        $('#disputeOpenModal input[name="order_received"]').on('ifChecked', function () {
            if ($(this).val() == 1) {
                $('#select_disputed_item, #return_goods_checkbox').removeClass('hidden').addClass('show');
                $('#select_disputed_item select#product_id').attr('required', 'required');
            }
            else{
                $('#select_disputed_item, #return_goods_checkbox').removeClass('show').addClass('hidden');
                $('#select_disputed_item select#product_id').removeAttr('required');
            }
        });
        $('#disputeOpenModal input#return_goods').on('ifChecked', function () {
            $('#return_goods_help_txt').removeClass('hidden').addClass('show');
        });
        $('#disputeOpenModal input#return_goods').on('ifUnchecked', function () {
            $('#return_goods_help_txt').removeClass('show').addClass('hidden');
        });
        //END DISPUTE FORM

        // Make recaptcha field required if exist
        var $recaptcha = document.querySelector('#g-recaptcha-response');
        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
    });

    //App plugins
    function initAppPlugins()
    {
        //Initialize validator
        $('#form, form[data-toggle="validator"]').validator({
            disable: false,
        });

        // Add-to-cart
        $(".sc-add-to-cart").on("click", function(e) {
            e.preventDefault();
            var item = $(this).closest('.sc-product-item');
            var qtt = item.find('input.product-info-qty-input').val();
            var shipTo = item.find('select#shipTo').val();
            var shippingZoneId = item.find('input#shipping-zone-id').val();
            var shippingRateId = item.find('input#shipping-rate-id').val();
            $.ajax({
                url: $(this).attr('href'),
                type: 'POST',
                data: {
                    'shipTo' : shipTo,
                    'shippingZoneId' : shippingZoneId,
                    'shippingRateId' : shippingRateId,
                    'quantity': qtt ? qtt : 1
                },
                complete: function (xhr, textStatus) {
                    if(200 == xhr.status){
                        @include('layouts.notification', ['message' => trans('theme.notify.item_added_to_cart'), 'type' => 'success', 'icon' => 'check-circle'])
                        // Increase global cart item count by 1
                        increaseCartItem(1);
                    }
                    else if(444 == xhr.status){
                        @include('layouts.notification', ['message' => trans('theme.notify.item_added_already_in_cart'), 'type' => 'info', 'icon' => 'info-circle'])
                    }
                    else{
                        @include('layouts.notification', ['message' => trans('theme.notify.failed'), 'type' => 'warning', 'icon' => 'times-circle'])
                    }
                },
            });
        });

        // Bootstrap fixes
        $('[data-toggle="tooltip"]').tooltip();

        // Owl Carousel
        $('.product-carousel').owlCarousel({
            margin:5,
            nav:true,
            responsive:{
                0:{items:3},
                600:{items:4},
                1000:{items:6}
            }
        });
        $('.big-carousel').owlCarousel({
            margin:5,
            nav:true,
            responsive:{
                0:{items:2},
                600:{items:3},
                1000:{items:4}
            }
        });
        $('.small-carousel').owlCarousel({
            margin:5,
            nav:true,
            responsive:{
                0:{items:3},
                600:{items:7},
                1000:{items:11}
            }
        });
        // End Owl Carousel

        // i-Check plugin
        $('.i-check, .i-radio').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal',
        });
        $('.i-check-blue, .i-radio-blue').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue',
        });

        // SelectBoxIt
        $(".selectBoxIt").selectBoxIt();

        // jqzoom
        $('#jqzoom').jqzoom({
            zoomType: 'standard',
            lens: true,
            preloadImages: false,
            alwaysOn: false,
            zoomWidth: 530,
            zoomHeight: 530,
            xOffset:0,
            yOffset: 0,
            position: 'left'
        });

        // summernote
        $('.summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
            focus: true,
            height: 90
        });

        //Datepicker
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd'
        });

        // Product qty field
        $(".product-info-qty-input").on('keyup', function() {
            var currentVal = parseInt($(this).val(), 10);
            var maxVal = parseInt($(this).data('max'), 10);
            if (!currentVal || currentVal == "" || currentVal == "NaN") currentVal = 1;
            else if(maxVal < currentVal) currentVal = maxVal;
            $(this).val(currentVal);
        });
        $(".product-info-qty-plus").on('click', function(e) {
            e.preventDefault();
            var node = $(this).prev(".product-info-qty-input");
            var currentVal = parseInt(node.val(), 10);

            if (!currentVal || currentVal == "" || currentVal == "NaN") currentVal = 0;
            if(node.data('max') > currentVal){
                node.val(currentVal + 1).change();
            }
            else{
                @include('layouts.notification', ['message' => trans('theme.notify.max_item_stock'), 'type' => 'warning', 'icon' => 'times-circle'])
            }
        });
        $(".product-info-qty-minus").on('click', function(e) {
            e.preventDefault();
            var node = $(this).next(".product-info-qty-input");
            var currentVal = parseInt(node.val(), 10);
            if (currentVal == "NaN") currentVal = node.data('min');
            if (currentVal > node.data('min')){
                $(this).next(".product-info-qty-input").val(currentVal - 1).change();
            }
            else{
                @include('layouts.notification', ['message' => trans('theme.notify.minimum_order_qtt_reached'), 'type' => 'warning', 'icon' => 'times-circle'])
            }
        });
        // END Product qty field
    }

    // Filters
    $("#price-slider").ionRangeSlider({
        hide_min_max: true,
        keyboard: true,
        min: {{ $priceRange['min'] ?? 0 }},
        max: {{ $priceRange['max'] ?? 5000 }},
        from: {{ Request::get('price') ? explode('-', Request::get('price'))[0] : $priceRange['min'] ?? 0 }},
        to: {{ Request::get('price') ? explode('-', Request::get('price'))[1] : $priceRange['max'] ?? 5000 }},
        step: 10,
        type: 'double',
        prefix: "{{ get_formated_currency_symbol() ?? '$'}}",
        grid: true,
        onFinish: function (data) {
            var href = removeQueryStringParameter(window.location.href, 'price'); //Remove currect price
            window.location.href = getFormatedUrlStr(href, 'price='+ data.from + '-' + data.to);
        },
    });

    $('#filter_opt_sort').on('change', function(){
        var opt = $(this).attr('name');
        var href = removeQueryStringParameter(window.location.href, opt); //Remove currect sorting
        opt = opt + '=' + $(this).val();
        window.location.href = getFormatedUrlStr(href, opt);
    });
    $('.filter_opt_checkbox').on('ifChecked', function() {
        var opt = $(this).attr('name') + '=true';
        window.location.href = getFormatedUrlStr(window.location.href, opt);
    });
    $('.filter_opt_checkbox').on('ifUnchecked', function() {
        var opt = $(this).attr('name');
        var href = removeQueryStringParameter(window.location.href, 'page'); //Reset the pagination
        window.location.href = removeQueryStringParameter(href, opt);
    });

    $('.link-filter-opt').on('click', function(e){
        e.preventDefault();
        var opt = $(this).data('name');
        var href = removeQueryStringParameter(window.location.href, opt); //Remove currect filter
        window.location.href = getFormatedUrlStr(href, opt+'='+ $(this).data('value'));
    });

    $('.clear-filter').on('click', function(e){
        e.preventDefault();
        window.location.href = removeQueryStringParameter(window.location.href, $(this).data('name')); //Remove the filter
    });

    // Helper functions
    function getFormatedUrlStr(sourceURL, opt) {
        var url = removeQueryStringParameter(sourceURL, 'page'); //Reset the pagination;
        if(url.indexOf('?') !== -1)
            return url + '&' + opt;

        return url + '?' + opt;
    }

    function removeQueryStringParameter(sourceURL, key) {
        var rtn = sourceURL.split("?")[0],
            param,
            params_arr = [],
            queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
        if (queryString !== "") {
            params_arr = queryString.split("&");
            for (var i = params_arr.length - 1; i >= 0; i -= 1) {
                param = params_arr[i].split("=")[0];
                if (param === key) {
                    params_arr.splice(i, 1);
                }
            }
            rtn = rtn + "?" + params_arr.join("&");
        }
        return rtn;
    }
}(window.jQuery, window, document));

// Helpers
function getFormatedValue(value = 0, dec = {{config('system_settings.decimals', 2)}})
{
    value = value ? value : 0;
    return parseFloat(value).toFixed(dec);
}

function getFormatedPrice(value = 0, trim = true)
{
    var symbol = '';
    if ('{{config('system_settings.show_currency_symbol')}}')
        symbol = '{{ config('system_settings.currency.symbol') . (config('system_settings.show_space_after_symbol') ? ' ' : '') }}';

    var value = getFormatedValue(value);
    var arr = value.split(".");

    if(arr[1])
        value = arr[1] > 0 ? arr[0] + '<sup class="price-fractional">' + arr[1] + '</sup>' : arr[0];

    return symbol + value;
}

// Update global cart item count
function increaseCartItem(value = 1)
{
    return setCartItemCount(getCartItemCount() + value);
}
function decreaseCartItem(value = 1)
{
    return setCartItemCount(getCartItemCount() - value);
}
function getCartItemCount()
{
    return Number(jQuery("#globalCartItemCount").text());
}
function setCartItemCount(value = 0)
{
    jQuery('#globalCartItemCount').text(value);
    return;
}

function apply_busy_filter(dom = 'body') {
    jQuery(dom).addClass('busy');
    jQuery('#loading').show();
}
function remove_busy_filter(dom = 'body') {
    jQuery(dom).removeClass('busy');
    jQuery('#loading').hide();
}

 /*
 * Get result from PHP helper functions
 *
 * @param  {str} funcName The PHP function name will be called
 * @param  {mix} args arguments need to pass into the PHP function
 *
 * @return {mix}
 */
function getFromPHPHelper(funcName, args = null)
{
    var url = "{{ route('helper.getFromPHPHelper') }}";
    var result = 0;
    jQuery.ajax({
        url: url,
        data: "funcName="+ funcName + "&args=" + args,
        async: false,
        success: function(v){
          result = v;
        }
    });
    return result;
}
</script>