@extends('layouts.app')

@section('content')
            <div id='calendar' style=""></div>
@endsection

@push('css')
    <link rel='stylesheet' href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css'>
    <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/timeline@4.3.0/main.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/resource-timeline@4.3.0/main.min.css">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>
    <script src="{{ asset('js/calendar.js') }}" defer></script>
@endpush
