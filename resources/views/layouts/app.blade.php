<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project JQuery</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        table th, td {
            border: 2px solid black;
            padding: 15px;
            text-align: left;
        }
    </style>

    <!-- Scripts -->
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
</head>
<body>
        @yield('content')


</body>
</html>
@yield('script')
