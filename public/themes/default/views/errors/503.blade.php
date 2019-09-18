<!DOCTYPE html>
<html>
    <head>
        <title>@lang('theme.shop_down')</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 52px;
                margin-bottom: 40px;
            }
            a {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <a href="{{ url('/') }}">
                    <img src="{{ Storage::url('logo.png') }}" alt="LOGO" title="LOGO" />
                </a>
                <div class="title">@lang('theme.shop_down')</div>
                <a href="{{ url()->previous() }}">@lang('theme.button.go_back')</a>
            </div>
        </div>
    </body>
</html>
