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

        .edit-page{
            display: inline-block;
        }

        .form {
            margin-top: 50px;
            margin-left: 200px;;
            padding: 50px;
            text-align: left;
            border-style: ridge;
        }

        .panel-heading {
            font-size: 18px;
        }

        .button-add{
            padding: 20px;
        }

        .button-edit{
            padding: 20px;
        }

        .checked {
            opacity: 0.5;
        }

        .images{
            display: inline-block;
            padding-left: 30px;
            padding-right: 50px;
        }

        .image{
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
