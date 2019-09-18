<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">

    <title>{{ $title ?? get_site_title() }}</title>

    <link rel="icon" href="{{ Storage::url('icon.png') }}" type="image/x-icon" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="apple-touch-icon" href="{{ Storage::url('icon.png') }}">

    <!-- Scripts -->
    <link href="{{ mix("css/app.css") }}" rel="stylesheet">
    <link href="{{ mix("css/vendor.css") }}" rel="stylesheet">

    <!-- START Page specific Stylesheets -->
    @yield("page-style")
    <!-- END Page specific Stylesheets -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-blue-light                         |
  |               | skin-black                              |
  |               | skin-black-light                        |
  |               | skin-purple                             |
  |               | skin-purple-light                       |
  |               | skin-yellow                             |
  |               | skin-yellow-light                       |
  |               | skin-red                                |
  |               | skin-red-light                          |
  |               | skin-green                              |
  |               | skin-green-light                        |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      @include('admin.header')

      @include('admin.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          @if (View::hasSection('buttons') || isset($page_title))
            <section class="content-header">
              <h1>
                {{ $page_title ?? '' }}
                <small>{{ $page_description ?? '' }}</small>
              </h1>
              <span class='opt-button'>

                @yield("buttons")

              </span>
            </section>
          @endif

          <!-- Main content -->
          <section class="content">

          {{-- If the user is impersonated --}}
          @if(Request::session()->has('impersonated'))
            <div class="callout callout-info">
              <p>
                <strong><i class="icon ion-md-nuclear"></i> {{ trans('app.alert') }}</strong>
                {{ trans('messages.you_are_impersonated') }}
                <a href="{{ route('admin.secretLogout') }}" class="nav-link pull-right"><i class="fa fa-sign-out" data-toggle="tooltip" data-placement="top" title="{{ trans('app.log_out') }}"></i></a>
              </p>
            </div>
          @endif

          <!-- VALIDATION ERRORS -->
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>{{ trans('app.error') }}!</strong> {{ trans('messages.input_error') }}<br><br>
              <ul class="list-group">
                  @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                  @endforeach
              </ul>
            </div>
          @endif

          {{-- Global Notice --}}
          <div id="global-alert-box" class="alert alert-warning alert-dismissible {{ Session::has('global_msg') ? '' : 'hidden'}}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> {{ trans('app.alert') }}</h4>
            <p id="global-alert-msg">{{ Session::get('global_msg') }}</p>
          </div>

          <div id="global-notice-box" class="alert alert-info alert-dismissible {{ Session::has('global_notice') ? '' : 'hidden'}}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info-circle"></i> {{ trans('app.notice') }}</h4>
            <p id="global-notice">{{ Session::get('global_notice') }}</p>
          </div>

          <div id="global-error-box" class="alert alert-danger alert-dismissible {{ Session::has('global_error') ? '' : 'hidden'}}">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-stop-circle-o"></i> {{ trans('app.error') }}</h4>
            <p id="global-error">{{ Session::get('global_error') }}</p>
          </div> <!-- /#global-alert-box -->

          @yield("content")

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      @include('admin.footer')

      @include('admin.control_sidebar')

      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

      <!--Modal-->
      <div id="myDynamicModal" class="modal fade" aria-hidden="true"></div>
    </div><!-- ./wrapper -->

    <div class="loader">
      <center>
        <img class="loading-image" src="{{ asset('images/gears.gif') }}" alt="busy...">
      </center>
    </div>

    <script src="{{ mix("js/app.js") }}"></script>
    <script src="{{ mix("js/vendor.js") }}"></script>

    {{-- START (Required by only the datetimepicker, Remove it after find a solution) --}}
    {{-- <script>var $Original = jQuery.noConflict(true);</script> --}}
    <!-- jQuery 2.1.4  -->
    {{-- <script src="{{ asset("assets/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script> --}}
    {{-- END (Required by only the datetimepicker) --}}

    <!-- Notification -->
    @include('admin.notification')

    <!-- START Page specific Script -->
    @yield("page-script")
    <!-- END Page specific Script -->

    <!-- Scripts -->
    @include('admin.footer_js')
  </body>
</html>