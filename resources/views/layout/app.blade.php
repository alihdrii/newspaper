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
            <form>
                @csrf
            </form>
            <vue-progress-bar></vue-progress-bar>
            <header>
                <div class="container-fluid fixed-top">
                    <div class="row justify-content-center" style="background-color: #1b4b72; padding:8px ">

                        <div class="container">
                            <div style="float: left;">
                                <ul class="list-inline d-none d-lg-block " style="color:#ffffff;margin-bottom: 0">

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
                                <ul class="list-inline d-block d-lg-none " style="margin-bottom: 0">
                                    <mobile-menu
                                        date="{{$data['general_header']['date']}}"
                                        clock="{{$data['general_header']['clock']}}"
                                    ></mobile-menu>
                                </ul>
                            </div>

                            <div style="float: right">
                                @auth
                                    <profile-header></profile-header>
                                @endauth
                                @guest
                                    <ul class="list-inline" style="margin:0; font-size:17px">
                                        <a href="#" data-target="#signInModal" data-toggle="modal" class="profileItems" style="color:#fff">
                                            <li class="list-inline-item">
                                                ورود
                                            </li>
                                        </a>
                                        <li class="list-inline-item">|</li>

                                        <a href="/registery"  class="profileItems" style="color:#fff">
                                            <li class="list-inline-item">
                                                خبر نگار شو
                                            </li>
                                        </a>
                                    </ul>
                                @endguest
                            </div>

                        </div>

                    </div>

                </div>

                <div class="row" style="margin:0;margin-top:40px;background-color: #fcf8e3; height: 100px;padding: 0">

                </div>

                <div style=" background-color:#1b4b72;">
                    <div class="container-fluid">
{{--                    menu header--}}
{{--                        <menu-header class="d-none d-lg-block"--}}
{{--                            :category="{{$data['category']}}"--}}
{{--                            place = "{{$data['general_header']['place']}}"--}}
{{--                        ></menu-header>--}}
{{--                        fsdsadasdas--}}
                        <menu-header class="d-none d-lg-block"></menu-header>
                    </div>
                </div>
            </header>
            @yield('content')

            @yield('footer')

            <div class="modal fade show" id="signInModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" style="overflow:hidden">
                        <popup-sign-in></popup-sign-in>
                    </div>
                </div>
            </div>
            <confirm-box></confirm-box>

        </div>

@auth
    <script>
        window.user = @json(Auth::user());
    </script>
@endauth

    </body>
</html>
