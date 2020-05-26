<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
{{--    #6c16f3--}}
        <div id="app">
            <header>
                <div class="container-fluid fixed-top">
                    <div class="row justify-content-center" style="background-color: #1b4b72; color:#ffffff; padding:8px ">

                        <div class="container">
                            <div style="float: left;">
                                <ul class="list-inline d-none d-lg-block " style="margin-bottom: 0">

                                    <li class="list-inline-item">
                                        <div style="background-color: blueviolet;box-shadow: 1px 1px 15px #cccccc; border-radius: 10px;">
                                            تبلیغات
                                        </div>
                                    </li>

                                    <li class="list-inline-item" style="font-size: 12px;">
                                        {{$data['general_header']['clock']}}
                                        <i class="fas fa-clock"></i>
                                    </li>
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item" style="font-size: 12px;">
                                        {{$data['general_header']['date']}}
                                        <i class="far fa-calendar"></i>
                                    </li>
                                    <li class="list-inline-item">|</li>
                                    <li class="list-inline-item">
                                        <i class="fab fa-instagram"></i>
                                        <i class="fab fa-twitter"></i>
                                    </li>
                                </ul>
                                
                            </div>

                            <div style="float: right">
                                <a href="/">logo</a>
                            </div>

                        </div>

                    </div>

                </div>

            @yield('content')

            @yield('footer')

        </div>

    </body>
</html>
