<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
    @stack('css')
</head>

<body>
    <header class="row">
        @include('includes.header')
    </header>

    <div class="container">

        <div class="row">
            @yield('content')
        </div>

        <footer class="row">
            @include('includes.footer')
        </footer>

    </div>
</body>

@stack('js')

</html>
