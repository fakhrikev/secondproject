<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project JQuery</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .product td{
            border: 2px solid black;
            padding: 15px;
            text-align: left;
        }

        .product_detail td{
            border: 2px solid black;
            padding: 15px;
            text-align: left;
        }

        .edit td{
            padding: 5px;
            text-align: left;
        }

        .button{
            padding: 10px;
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
