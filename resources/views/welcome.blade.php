<!DOCTYPE html>
<html>
    <head>
        <title>Student Management System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fontstyle.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">
        <script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
            .w3-bar-block .w3-bar-item {padding:20px}
        </style>
    </head>
    <body>

        @include('layouts.header')
        @yield('content')
        @yield('scriptincludes')
        <script>
            // Script to open and close sidebar
            function w3_open() {
                document.getElementById("mySidebar").style.display = "block";
            }
            
            function w3_close() {
                document.getElementById("mySidebar").style.display = "none";
            }
        </script>
    </body>
</html>