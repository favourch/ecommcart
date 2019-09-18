//Theme JavaScript
;(function($, window, document) {
    "use strict";
    $(document).ready(function(){
        $.ajaxSetup ({
            cache: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        // Make recaptcha field required if exist
        var $recaptcha = document.querySelector('#g-recaptcha-response');
        if($recaptcha) {
            $recaptcha.setAttribute("required", "required");
        }
    });

    // Activate the tab if the url has any #hash
    $('.nav a').on('show.bs.tab', function (e) {
        window.location = $(this).attr('href');
    });
    $(function () {
        var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
    });

    $("#contactForm input, #contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
          // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour

            var form = $("form#contactForm");
            var data = form.serialize();

            var submmitBtn = $("button[type=submit]");
            submmitBtn.prop("disabled", true); // Disable submit button until AJAX call is complete to prevent duplicate messages
            $.ajax({
                url: form.attr("action"),
                type: "POST",
                data: data,
                cache: false,
                success: function(response, textStatus, xhr) {
                    $('#success').html("<div class='alert alert-success'><strong>"+ response +"</strong></div>");
                },
                error: function(response, textStatus, xhr) {
                    if( jqXhr.status === 422 ) {
                        var errors = response.responseJSON.errors;
                        if(errors){
                            var errorsHtml= '<ul>';
                            $.each( errors, function( key, value ) {
                                errorsHtml += '<li>' + value[0] + '</li>';
                            });
                            errorsHtml += '</ul>';
                            $('#success').html("<div class='alert alert-danger'>"+ errorsHtml +"</div>");
                        }
                    }
                    else{
                        $('#success').html("<div class='alert alert-danger'><strong>"+ response.responseText +"</strong></div>");
                    }
                },
                complete: function(xhr, textStatus) {
                  $('#contactForm').trigger("reset"); //clear all fields
                  setTimeout(function() {
                    submmitBtn.prop("disabled", false); // Re-enable submit button when AJAX call is complete
                  }, 1000);
                }
            });
        },
        filter: function() {
          return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    });

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function(){
        $('.navbar-toggle:visible').click();
    });

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    /*When clicking on Full hide fail/success boxes */
    $('#name').focus(function() {
      $('#success').html('');
    });

}(window.jQuery, window, document));
