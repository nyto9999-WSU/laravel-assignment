@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row g-2 mx-2">

            <div class="col-3">
                <h2>Edit Job</h2>
                <small>All new service requests are shown in this page</small>
            </div>

            <div class="col-6">

            </div>

            <div class="col-3 mt-3 text-end">
                <h2 id="status">Status: {{ ucfirst($job->status) }}</h2>
                <hr>
            </div>
        </div>

        <form action="{{ route('order.update', [$order, $job]) }}" method="post">
            <div class="row g-2 mx-2 shadow-sm rounded border border-2 mt-2">
                @csrf
                @method('PATCH')
                <div class="col-md-12 mt-1">
                    <h6 id="aircon" class="ps-2 text-white fw-bold" style="height: 51px; padding-bottom:15px; padding-top:15px;">Aircon ID : {{ $job->aircon_id }}</h6>
                </div>

                {{-- model --}}
                <div class="col-md-6">
                    <label for="model_number">Model</label>
                    <input type="text" name="model_number" class="form-control" value="{{ $job->model_number }}">
                </div>

                {{-- serial --}}
                <div class="col-md-6">
                    <label for="serial_number">Serial</label>
                    <input type="text" name="serial_number" class="form-control" value="{{ $job->serial_number }}">
                </div>

                {{-- install_address --}}
                <div class="col-md-12">
                    <label for="install_address">Install Address</label>
                    <input type="text" name="install_address" class="form-control" value="{{ $job->install_address }}">
                </div>

                {{-- equipment_type --}}
                <div class="col-md-6">
                    <label for="equipment_type">Equipment Type</label>
                    <select class="form-select" name="equipment_type">
                        <option value="{{ $job->equipment_type }}">{{ $job->equipment_type }}</option>
                        <option>Spilt System</option>
                        <option>Ducted System</option>
                        <option>Package unit</option>
                        <option>Watercool unit</option>
                        <option>Mini VRF</option>
                    </select>
                </div>

                {{-- domestic_commercial --}}
                <div class="col-md-6">
                    <label for="domestic_commercial" class="form-label m-0">Domestic / Commercial</label>
                    <select class="form-select" name="domestic_commercial" id="domestic_commercial">
                        <option value="{{ $job->domestic_commercial }}">{{ $job->domestic_commercial }}</option>
                        <option>Domestic</option>
                        <option>Commercial</option>
                    </select>
                </div>

                {{-- prefer_date --}}
                <div class="col-md-6">

                    <label for="start_date">Client {{ $order->name }} Prefer Date</label>

                    @if (!empty($job->prefer_date))
                        <input type="text" class="form-control" id="datepicker" name="prefer_date"
                            value="{{ date('d-m-Y', strtotime($job->prefer_date)) }}">
                    @else
                        <input type="text" class="form-control" id="datepicker" name="prefer_date">
                    @endif

                </div>

                {{-- prefer_time --}}
                <div class="col-md-6">
                    <label for="prefer_time">Client {{ $order->name }} Prefer Time</label>
                    <select class="form-select w-100" name="prefer_time">
                        <option value="{{ $job->prefer_time }}">{{ $job->prefer_time }}</option>
                        <option>Morning</option>
                        <option>Afternoon</option>
                        <option>Evening</option>
                    </select>
                </div>

                {{-- issue --}}
                <div class="col-md-12">
                    <label for="issue" class="form-label mb-0">Issue</label>
                    <textarea class="form-control" name="issue" cols="30" rows="2">{{ $job->issue }}</textarea>
                </div>

                @if ($job->status != 'booked')
                    {{-- title 2 --}}
                    <div class="col-md-12 m-0">
                        <h6 id="job" class="ps-2 mt-2 text-white fw-bold" style="height: 51px; padding-bottom:15px; padding-top:15px;">Job ID : {{ $job->id }}</h6>
                    </div>

                    <div class="col-md-6">
                        {{-- start_date --}}
                        <label for="start_date">Start Date</label>

                        @if (!empty($job->start_date))
                            <input type="text" class="form-control" id="datepicker-start-date" name="start_date"
                                value="{{ date('d-m-Y', strtotime($job->start_date)) }}">
                        @else
                            <input type="text" class="form-control" id="datepicker-start-date" name="start_date">
                        @endif

                    </div>
                    <div class="col-md-6">

                        {{-- start_time --}}
                        <label for="start_time">Start Time</label>
                        <select class="form-select w-100" name="start_time">
                            <option value="{{ $job->start_time }}">{{ $job->start_time }}</option>
                            <option>Morning</option>
                            <option>Afternoon</option>
                            <option>Evening</option>
                        </select>
                    </div>

                    {{-- technician --}}
                    <div class="mt-2 mb-2">
                        <label for="tech_name">Techinicain</label>
                        <select class="form-select" name="tech_name">
                            <option value="{{ $job->tech_name }}">{{ $job->tech_name }}</option>
                            @forelse ($technicians as $t)
                                <option value="{{ $t->name }}">{{ $t->name }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                    @if ($job->status == 'assigned')
                        {{-- status-assigned to booked --}}
                        <div class="mt-2 mb-2">
                            <label for="status">Current Status : {{ $job->status }}</label><br>
                            <p class="text-danger">Would you like to return the status to "Booked"
                                ?
                                <input type="checkbox" class="form-check-input" name="booked">
                            </p>
                        </div>
                    @else
                        {{-- status-completed to assigned --}}
                        <div class="mt-2 mb-1">
                            <label for="status">Current Status : {{ ucfirst($job->status) }}</label>
                            <p class="text-danger">Would you like to return the status to
                                "Assigned" ?
                                <input type="checkbox" class="form-check-input" name="assigned">
                            </p>
                        </div>
                    @endif
                @endif
                <hr class="mb-2 mt-2">
                <div class="col-md-12">
                    <button id="submit-btn" type="save" class="w-100 btn text-white mb-1">Save</button>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        $('#datepicker').datepicker("setDate", new Date());
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: '0'
        });
    </script>

    <script>
        $('#datepicker-start-date').datepicker("setDate", new Date());
        $("#datepicker-start-date").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: '0'
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        switch ($('#status').html()) {
            case 'Status: Booked':
                $('#title').text('Edit Requested Job');
                $('#aircon').css('background-color', '#A33431');
                $('#job').css('background-color', '#A33431');
                $('#submit-btn').css('background-color', '#A33431');
                break;

            case 'Status: Completed':
                $('#title').text('Edit Completed Job');
                $('#aircon').css("background-color", "#366B2C");
                $('#job').css('background-color', '#366B2C');
                $('#submit-btn').css("background-color", "#366B2C");
                break;

            default:
                $('#title').text('Edit Assigned Job');
                $('#aircon').css('background-color', '#005aa4');
                $('#job').css('background-color', '#005aa4');
                $('#submit-btn').css('background-color', '#005aa4');
                break
        }
    </script>

@endpush
