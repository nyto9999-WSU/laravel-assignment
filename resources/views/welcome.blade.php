<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">


    <title>Pioneer Air Conditioner</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .btn-squared-default {
            width: 20vh !important;
            height: 25vh !important;
        }

    </style>
</head>

<body>
    <div class="text-center">

        <div class="row align-items-center " style="height:600px;">

            <div class="w-100 text-center">
                <img src="{{ asset('image/logo.png') }}" class="img-fluid" alt="Responsive image">
                <h1 class="text-center">Welcome to Pioneer Aircon</h1>
                <br>

                <a class="btn btn-primary btn-squared-default btn-lg m-2 border border-dark border border-2"
                    href="{{ route('login') }}" role="button">
                    <svg class="svg-inline--fa fa-user-circle fa-w-16 fa-6x mb-3" viewBox="0 0 496 512">
                        {{-- viewBox size x,y,w,h --}}
                        <path fill="currentColor"
                            d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z">
                        </path>
                    </svg>Login</a>

                <a class="btn btn-danger btn-squared-default btn-lg m-2 border border-dark border border-2"
                    href="{{ route('register') }}" role="button">
                    <svg class="svg-inline--fa fa-user-circle fa-w-16 fa-6x mb-3" viewBox="0 0 496 512">
                        <path fill="currentColor"
                            d="M480 160H32c-17.673 0-32-14.327-32-32V64c0-17.673 14.327-32 32-32h448c17.673 0 32 14.327 32 32v64c0 17.673-14.327 32-32 32zm-48-88c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm-64 0c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm112 248H32c-17.673 0-32-14.327-32-32v-64c0-17.673 14.327-32 32-32h448c17.673 0 32 14.327 32 32v64c0 17.673-14.327 32-32 32zm-48-88c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm-64 0c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm112 248H32c-17.673 0-32-14.327-32-32v-64c0-17.673 14.327-32 32-32h448c17.673 0 32 14.327 32 32v64c0 17.673-14.327 32-32 32zm-48-88c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24zm-64 0c-13.255 0-24 10.745-24 24s10.745 24 24 24 24-10.745 24-24-10.745-24-24-24z">
                        </path>
                    </svg>Register</a>

            </div>

            <!--Footer-->
            <footer class="my-5 pt-5 text-muted text-center text-small">
                <p class="mb-1">&copy; 2017–2022 Pioneer Air Conditioner</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Privacy</a></li>
                    <li class="list-inline-item"><a href="#">Terms</a></li>
                    <li class="list-inline-item"><a href="#">About us</a></li>

                </ul>
            </footer>
        </div>
    </div>
</body>
</html>
