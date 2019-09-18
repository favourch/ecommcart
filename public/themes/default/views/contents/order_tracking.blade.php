<!-- CONTENT SECTION -->
<div class="space30"></div>
<section>
  <div class="container">
    <div class="row">
        @if( $order->carrier_id && $order->getTrackingUrl() )
            <iframe src="{{ $order->getTrackingUrl() }}"></iframe>
        @else
            <div class="col-md-8 col-md-offset-2">
                <div class="input-group">
                    <!--Tracking number input box.-->
                    <input id="YQNum" value="{{ $order->tracking_id }}" placeholder="@lang('theme.help.give_tracking_number_here')" class="form-control flat input-lg" type="text" maxlength="50" required="required" />
                    <!--The button is used to call script method.-->
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-lg flat" type="button" onclick="doTrack()">@lang('theme.button.track_order')</button>
                    </span>
                </div>
                <!--Container to display the tracking result.-->
                <div id="YQContainer"></div>
            </div>
        @endif
    </div>
  </div>
</section>
<!-- END CONTENT SECTION -->

<div class="space20"></div>

<!--Script code can be put in the bottom of the page, wait until the page is loaded then execute.-->
<script type="text/javascript" src="//www.17track.net/externalcall.js"></script>
<script type="text/javascript">
    function doTrack() {
        var num = document.getElementById("YQNum").value;
        if(num===""){
            alert("Enter your number.");
            return;
        }
        YQV5.trackSingle({
            //Required, Specify the container ID of the carrier content.
            YQ_ContainerId:"YQContainer",
            //Optional, specify tracking result height, max height 800px, default is 560px.
            YQ_Height:560,
            //Optional, select carrier, default to auto identify.
            YQ_Fc:"0",
            //Optional, specify UI language, default language is automatically detected based on the browser settings.
            YQ_Lang:"en",
            //Required, specify the number needed to be tracked.
            YQ_Num:num
        });
    }
</script>