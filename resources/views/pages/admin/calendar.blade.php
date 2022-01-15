@extends('layouts.app')

@section('content')

        <div id='calendar'></div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>
    <script>
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            timeZone: 'UTC',
            allDaySlot: false,
            slotDuration: '03:00',
            minTime: "09:00",
            maxTime: "18:00",
            contentHeight: "auto",
            defaultView: 'timeGridWeek',
            defaultDate: new Date(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            handleWindowResize: true,
            Boolean,
            default: false,
            businessHours: {
                daysOfWeek: [1, 2, 3, 4, 5],
                startTime: '9:00',
                endTime: '18:00',
            },
            editable: false,
            droppable: false,
            events: [

                @php
                if($requested_id != null)
                {
                    for($i = 0; $i < count($requested_id) ; $i++)
                    {
                        echo "{
                        id: '$requested_id[$i]',
                        title: 'Requested Job ID: $requested_id[$i] \\n Model: $r_model[$i] \\n Serial: $r_serial[$i] \\n Mobile: $r_mobile[$i] \\n Install Address: $r_install_address[$i] \\n Service Type: $r_dc[$i]',
                        start: '$prefer_start[$i]',
                        end: '$prefer_end[$i]',
                        backgroundColor: '#B83520',
                        },";

                    }
                }
                @endphp

                @php
                if($assigned_id != null)
                {
                    for($i = 0; $i < count($assigned_id) ; $i++)
                    {
                        echo "{
                        id: '$assigned_id[$i]',
                        title: 'Assigned Job ID: $assigned_id[$i] \\n Model: $a_model[$i] \\n Serial: $a_serial[$i] \\n Mobile: $a_mobile[$i] \\n Install Address: $a_install_address[$i] \\n Technician: $tech_name[$i] \\n Service Type: $a_dc[$i]',
                        start: '$job_start[$i]',
                        end: '$job_end[$i]',
                        backgroundColor: '#005aa4',
                        },";

                    }
                }
                @endphp


            ],



        });

        calendar.render();
    </script>

@endpush
