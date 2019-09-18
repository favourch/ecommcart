<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Munna Khan">
        @if(isset($item))
            <meta property="og:image" content="{{ get_product_img_src($item, 'large') }}">
        @endif
        <title> {{ get_platform_title() }} </title>
        <link rel="icon" href="{{ Storage::url('icon.png') }}" type="image/x-icon" />
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <link rel="apple-touch-icon" href="{{ Storage::url('icon.png') }}">
        <link href='https://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>

        <link href="{{ theme_asset_url('css/vendor.css') }}" rel="stylesheet">
        <link href="{{ theme_asset_url('css/style.css') }}" rel="stylesheet">
        <link href="{{ theme_asset_url('css/jquery.simplecolorpicker.css') }}" rel="stylesheet">
    </head>
    <body>
        <!--[if lte IE 9]>
          <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        @if(Session::has('global_announcement'))
            <div id="global-announcement">
                {!! session('global_announcement')->parsed_body !!}
                @if(session('global_announcement')->action_url)
                  <span class="indent10">
                    <a href="{{ session('global_announcement')->action_url }}" class="btn btn-primary flat btn-sm">
                        {{ session('global_announcement')->action_text }}
                    </a>
                  </span>
                @endif
            </div>
        @endif

        <div id="global-wrapper" class="clearfix">
            <!-- VALIDATION ERRORS -->
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>{{ trans('theme.error') }}!</strong> {{ trans('messages.input_error') }}<br><br>
                  <ul class="list-group">
                      @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                      @endforeach
                  </ul>
                </div>
            @endif

            <!-- MAIN NAVIGATIONS -->
            @include('nav.main')

            <!-- MAIN CONTENT -->
            <div id="content-wrapper">
                @yield('content')
            </div>

            <!-- MAIN FOOTER -->
            @include('nav.footer')

            <!-- COPYRIGHT AREA -->
            @include('nav.copyright')
        </div><!-- /#global-wrapper -->

        <div id="loading">
            <img id="loading-image" src="{{ theme_asset_url('img/loading.gif') }}" alt="busy...">
        </div>

        <!-- MODALS -->
        @unless(Auth::guard('customer')->check())
            @include('auth.modals')
        @endunless

        <!-- Quick view Modal-->
        <div id="quickViewModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

        <!-- SCRIPTS -->
        <script src="{{ theme_asset_url('js/vendor.js') }}"></script>
        <script src="{{ theme_asset_url('js/jquery.simplecolorpicker.js') }}"></script>

        <!-- Notification -->
        @include('notifications')

        <!-- AppJS -->
        @include('scripts.appjs')

        <!-- Page Scripts -->
        @yield('scripts')

    </body>
</html>