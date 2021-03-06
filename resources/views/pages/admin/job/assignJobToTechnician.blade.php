@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row g-2 mx-2">
            <div class="col-3">
                <h2>Assign job to Technician</h2>
                <small>All new service requests are shown in this page</small>
            </div>

            <div class="col-6">

            </div>

            <div class="col-3 mt-3 text-end">
                <a href="" id="blue" class="btn text-white fw-bold" style="opacity: 0.9;" data-bs-toggle="modal"
                    data-bs-target=".bd-example-modal-xl">View Job</a>
                <hr>

                {{-- modal calendar --}}
                <div class="modal fade bd-example-modal-xl " id="exampleModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog modal-xl modal-dialog-scrollable">

                        <div class="modal-content">
                            <div class="modal-header p-2">
                                <h5 class="modal-title">Prefer Date: {{ date('d-M-Y', strtotime($job->prefer_date)) }} / Prefer Time: {{ $job->prefer_time }}</h5>
                            </div>
                            <div id='calendar' class="modal-body m-0 p-3"></div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- assign table left --}}
            <div class="col-md-9 shadow-sm px-1 rounded border border-2 pb-0">
                <table class="table table-hover  text-start mb-2 mt-1">

                    {{-- Aircon --}}
                    <th id="blue" colspan="2" class="text-white">
                        Aircon ID : {{ $job->aircon_id }}
                    </th>

                    {{-- model_number --}}
                    <tr>
                        <td>Model Number</td>
                        <td>
                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                {{ $aircon->model_number }}
                            </a>
                        </td>
                    </tr>

                    {{-- serial_number --}}
                    <tr>
                        <td>Serial Number</td>
                        <td>
                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                {{ $aircon->serial_number }}
                            </a>
                        </td>
                    </tr>

                    {{-- domestic_commercial --}}
                    <tr>
                        <td>Domestic Commercial</td>
                        <td>{{ $aircon->domestic_commercial }}</td>
                    </tr>

                    {{-- equipment_type --}}
                    <tr>
                        <td>Equipment Type</td>
                        <td>{{ $aircon->equipment_type }}</td>
                    </tr>

                    {{-- install_address --}}
                    <tr>
                        <td>Installation Address</td>
                        <td>{{ $aircon->install_address }}</td>
                    </tr>

                    {{-- issue --}}
                    <tr>
                        <td>Issue</td>
                        <td>{{ $job->issue }}</td>
                    </tr>
                    {{-- job_id --}}
                    <th id="blue" colspan="2" class="text-white">
                        Job ID : {{ $job->id }}
                    </th>

                    {{-- prefer_date --}}
                    <tr>
                        <td>Prefer Date</td>
                        <td class="text-danger fw-bold">{{ date('d-M-Y', strtotime($job->prefer_date)) }}</td>
                    </tr>

                    {{-- prefer_time --}}
                    <tr>
                        <td>Prefer Time</td>
                        <td class="text-danger fw-bold">{{ $job->prefer_time }}</td>
                    </tr>

                    {{-- Description --}}
                    <tr>
                        <td>Description</td>
                        <td>{{ $order->extra_note }}</td>
                    </tr>

                    {{-- owner --}}
                    <th id="blue" colspan="2" class="text-white">
                        Owner : {{ $order->name }}
                    </th>


                    {{-- email --}}
                    <tr>
                        <td>Email Address</td>
                        <td>{{ $order->email }}</td>
                    </tr>



                    {{-- mobile_number --}}
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $order->mobile_number }}</td>
                    </tr>



                    {{-- status --}}
                    <tr>
                        <td>Status</td>
                        <td>{{ $job->status }}</td>
                    </tr>

                    {{-- success alert --}}
                    <tr id="js-alert" style="display:none">
                        <td colspan="2" class="bg-warning text-center">Add note successfully</td>
                    </tr>
                </table>
            </div>

            {{-- assign table right --}}
            <div class="col-3">
                <div class="col-12 shadow-sm px-1 py-1 rounded border border-2">
                    <form action="{{ route('job.store', [$job, $order]) }}" method="post">
                        @csrf

                        {{-- choose time title --}}
                        <div id="blue" class="text-center px-2 mb-1 text-white">
                            <div class="pt-2" style="height: 49px">
                                Choose Time and Date
                            </div>
                        </div>

                        {{-- job_start_date --}}
                        <label for="start_date">Start Date</label>
                        <input type="text" class="form-select" id="datepicker" name="start_date">

                        {{-- job_start_time --}}
                        <label for="start-time">Start Time</label>
                        <select class="form-select w-100" name="start_time">
                            <option value="">Choose...</option>
                            <option>Morning</option>
                            <option>Afternoon</option>
                            <option>Evening</option>
                        </select>

                        {{-- add technician --}}
                        <div class="mt-2 mb-2">
                            <label for="tech_name">Techinicain</label>
                            <select class="form-select" name="tech_name">
                                <option disabled selected value>Technician</option>
                                @forelse ($technicians as $t)
                                    <option value="{{ $t->name }}">{{ $t->name }}</option>
                                @empty
                                    <option disabled selected value>No available technicians</option>
                                @endforelse
                            </select>
                        </div>

                        {{-- add ntoe title --}}
                        <div id="blue" class="text-center px-2 mb-1 text-white">
                            <div class="pt-2" style="height: 49px">
                                Notes
                            </div>
                        </div>

                        {{-- notes record --}}
                        <div class="mt-2 mb-2">
                            <ul class="list-group bg-white" id="js-notes" style="height: 180px; overflow: auto">

                                @forelse ($job->notes as $note)
                                    <li class="wraptext-li">
                                        {{ $note->description }}
                                    </li>
                                @empty

                                @endforelse
                            </ul>
                        </div>

                        {{-- textarea --}}
                        <div class="mt-1" style="display: block;">
                            <textarea id="textarea" name="description" rows="3" class="form-control mb-1"></textarea>

                            {{-- js note submit --}}
                            <button id="js-note-submit" class="w-100 btn btn-secondary text-white mb-1">Add
                                Note</button>
                        </div>

                        {{-- Assign btn --}}
                        <button type="submit" id="blue"
                            class="w-100 btn border border-dark text-white font-weight-bold">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel='stylesheet' href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css'>
    <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/timeline@4.3.0/main.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@fullcalendar/resource-timeline@4.3.0/main.min.css">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>
    <script>
        $('#datepicker').datepicker("setDate", new Date());
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: '0'
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#js-note-submit').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: '/note/ajax',
                    data: {
                        'id': {{ $job->id }},
                        'description': $("#textarea").val()
                    },
                    success: function(response) {
                        var row = "";
                        $("#js-alert").show().delay(900).fadeOut();
                        $("#js-notes").empty();
                        console.log(response);
                        $.each(response, function(idx, obj) {
                            row += ("<li class='wraptext-li'>" + obj.description +
                                "</li>");
                        });

                        $("#js-notes").html(row);
                    }
                });

            });
        });
    </script>

    {{-- calendar --}}
    <script>
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

            plugins: ['dayGrid', 'timeGrid'],
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
            aspectRatio: 2.5,
            handleWindowResize: true,
            Boolean,
            default: true,
            businessHours: {
                daysOfWeek: [1, 2, 3, 4, 5],
                startTime: '9:00',
                endTime: '18:00',
            },
            editable: false,
            droppable: false,
            events: [

                @php
                if ($requested_id != null) {
                    for ($i = 0; $i < count($requested_id); $i++) {
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
                if ($assigned_id != null) {
                    for ($i = 0; $i < count($assigned_id); $i++) {
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
