<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  $(document).ready(function() {
    Stripe.setPublishableKey("{{ config('services.stripe.key') }}");

    // target the form
    // on form submission, create a token
    $('#stripe-form').submit(function(e) {
      e.preventDefault();

      var parentNode = $('.login-box').length > 0 ? $(".login-box") : $(".wrapper");

      $('.loader').show();
      parentNode.addClass('blur-filter');

      var form = $(this)

      Stripe.card.createToken(form, function(status, response) {
        if (response.error) {
          form.find('.stripe-errors').text(response.error.message).removeClass('hide');
          $('.loader').hide();
          parentNode.removeClass('blur-filter');
        } else {
          // console.log(response);

          // append the token to the form
          form.append($('<input type="hidden" name="cc_token">').val(response.id));

          // submit the form
          form.get(0).submit();
        }
      });
    });
  });
</script>
