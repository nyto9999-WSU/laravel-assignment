<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Pioneer International</title>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

{{-- custom css --}}
<link href="{{ asset('css/custom-css.css') }}" rel="stylesheet">

{{-- prevent scrollbar shaking --}}
<style>

</style>

{!! ReCaptcha::htmlScriptTagJsApi() !!}
