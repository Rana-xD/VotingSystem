<!-- Core js default app -->
<script src="{{ asset('js/app.js') }}"></script>

<!--   Core JS Files   -->
<!-- <script src="{{ asset('js/core/jquery-1.11.1.min.js') }}" ></script> -->
<script src="{{ asset('js/core/popper.min.js') }}" ></script>
<script src="{{ asset('js/bootstrap-material-design.js') }}" ></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}" ></script>

<!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
<script src="{{ asset('js/plugins/chartist.min.js') }}" ></script>

<!-- Library for adding dinamically elements -->
<script src="{{ asset('js/plugins/arrive.min.js') }}" type="text/javascript"></script>

<!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
<script src="{{ asset('js/plugins/bootstrap-notify.js') }}" ></script>

<!-- Material Dashboard Core initialisations of plugins and Bootstrap Material Design Library -->
<script src="{{ asset('js/material-dashboard.js?v=2.0.0') }}" ></script>

<script src="{{ asset('js/libraries.js') }}" ></script>
<script src="{{ asset('js/scripts.js') }}" ></script>
@yield('include_script')
@yield('execute_script')
