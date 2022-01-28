@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row g-2 mx-2">

            <div class="col-3">
                <h2>AirconDetails</h2>
                <small>The aircon details are shown in this page</small>
            </div>

            <div class="col-6">

            </div>


            <div class="col-12 shadow-sm rounded border border-2">

                <table class="table table-hover text-start mt-1">

                    <thead class="text-white">
                        <tr id="title">
                            <th>ID</th>
                            <th>Model Number</th>
                            <th>Serial Number</th>
                            <th>Equipment Type</th>
                            <th>Domestic / Commercial</th>
                            <th>Install Address</th>
                            <th>Issue</th>
                            <th>Status</th>


                        </tr>
                    </thead>
                    <tbody id="AirconDetails">
                        <tr>
                            {{-- job_id --}}
                            <td>{{ $job->id }}</td>

                            {{-- model_number/serial_number --}}
                            <td>{{ $job->model_number }}</td>
                            <td>{{ $job->serial_number }}</td>

                            {{-- equipment_type --}}
                            <td>{{ $job->equipment_type }}</td>


                            {{-- domestic_commercial --}}
                            <td>{{ $job->domestic_commercial }}</td>

                            {{-- install_address --}}
                            <td>{{ $job->install_address }}</td>



                            {{-- issue --}}
                            <td>{{ $job->issue }}</td>

                            {{-- status --}}
                            <td id="status">{{ $job->status }}</td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            switch ($('#status').html()) {
                case 'booked':
                    $('#title').css('background-color', '#A33431');
                    break;

                case 'completed':
                    $('#title').css('background-color', '#366B2C');
                    break;

                default:
                    $('#title').css('background-color', '#005aa4');
                    break
            }
        </script>
    </div>
@endsection
