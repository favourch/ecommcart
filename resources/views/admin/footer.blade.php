<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="pull-right hidden-xs">
    <a href="https://incevio.com/" target="_blank">zCart Version: {{ \App\System::VERSION }}</a>
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; {{date('Y') }} {{ config('system_settings.name') ?: config('app.name') }}.</strong> All rights reserved.
</footer>