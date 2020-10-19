<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <title>GTUT客製功能平台</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    
        <!-- CSRF Token -->
        <meta name="_token" content="{{ csrf_token() }}">
    
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="css/fontawesome.css">
        <link rel="stylesheet" href="css/templatemo-style.css">
        <link rel="stylesheet" href="css/owl.css">

        @stack('plugin-styles')
        @stack('style')
    </head>


    <body class="is-preload">
        <!-- Wrapper -->
        <div id="wrapper">
            
            <!-- Main -->
            <div id="main">
                <div class="inner">
                    @include('layouts.header')
                    @yield('content')
                </div>
            </div>

            <!-- Sidebar -->
            <div id="sidebar">
                <div class="inner">
                    @include('layouts.sidebar')
                </div>
            </div>

            <!-- Scripts -->
            <!-- Bootstrap core JavaScript -->
            <script src="jquery/jquery.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>

            {{-- ajax --}}
            @include('layouts.script')
            <script src="js/browser.min.js"></script>
            <script src="js/breakpoints.min.js"></script>
            <script src="js/transition.js"></script>
            <script src="js/owl-carousel.js"></script>
            <script src="js/custom.js"></script>
        </div>
    </body>
</html>