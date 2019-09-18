<!-- CONTENT SECTION -->
<div class="clearfix space50"></div>
<section>
  <div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="contact-info">
                <h2 class="space20">&nbsp;</h2>
                <div class="media-list">
                    @if(config('system_settings.support_phone'))
                        <div class="media space20">
                            <i class="pull-left fa fa-phone"></i>
                            <div class="media-body">
                                <h4>@lang('theme.phone'):</h4>
                                {{ config('system_settings.support_phone') }}
                            </div>
                        </div>
                    @endif

                    @if(config('system_settings.support_phone_toll_free'))
                        <div class="media space20">
                            <i class="pull-left fa fa-phone-square"></i>
                            <div class="media-body">
                                <h4>@lang('theme.phone'): (@lang('theme.toll_free'))</h4>
                                {{ config('system_settings.support_phone_toll_free') }}
                            </div>
                        </div>
                    @endif

                    @if(config('system_settings.support_email'))
                        <div class="media space20">
                            <i class="pull-left fa fa-envelope-o"></i>
                            <div class="media-body">
                                <h4>@lang('theme.email'):</h4>
                                <a href="mailto:{{ config('system_settings.support_email') }}">{{ config('system_settings.support_email') }}</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div><!-- /.col-md-4 -->

        <div class="col-md-8">

            @include('forms.contact')

        </div><!-- /.col-md-8 -->
    </div>
  </div>
</section>
<!-- END CONTENT SECTION -->
<div class="clearfix space50"></div>