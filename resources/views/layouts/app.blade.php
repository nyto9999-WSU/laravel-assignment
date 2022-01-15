<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @stack('css')
    @include('includes.head')
</head>

<body>
    <header>
        @include('includes.header')
    </header>
    <div class="">
        @yield('content')
    </div>

    <footer>
        @include('includes.footer')
    </footer>

</body>

@stack('js')

</html>
