@include('backend.layouts.header')

@stack('style-css')

</head>
<body class="pace-done px-navbar-fixed">

@include('backend.layouts.sidebar')
@include('backend.layouts.navbar')

            @yield('content')

@if(Session::has('infos'))
<script type="text/javascript">
    swal({
        type: 'warning',
        title : 'Warning',
        text : '{{ Session::get("infos") }}',
    });
</script>

@endif
@include('backend.layouts.footer')
@stack('script-js')
</html>