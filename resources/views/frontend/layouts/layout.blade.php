@include('frontend.layouts.header')

@stack('style-css')

</head>
<body class="pace-done px-navbar-fixed">

@include('frontend.layouts.sidebar')
@include('frontend.layouts.navbar')

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
@include('frontend.layouts.footer')
@stack('script-js')
</html>