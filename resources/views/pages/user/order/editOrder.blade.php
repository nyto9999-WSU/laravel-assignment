@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('order.update', [$order, $job]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row g-2">
                        <h3 class="mb-0">Aircon Info</h3>

                        {{-- model --}}
                        <div class="col-md-6">
                            <label for="model_number">Model</label>
                            <input type="text" name="model_number" class="form-control" value="{{ $job->model_number }}">
                        </div>

                        {{-- serial --}}
                        <div class="col-md-6">
                            <label for="serial_number">Serial</label>
                            <input type="text" name="serial_number" class="form-control"
                                value="{{ $job->serial_number }}">
                        </div>

                        {{-- install_address --}}
                        <div class="col-md-12">
                            <label for="install_address">Install Address</label>
                            <input type="text" name="install_address" class="form-control"
                                value="{{ $job->install_address }}">
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
                            <h3 class="mb-0">Job Info</h3>

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

                    </div>
                    <button type="save" class="w-100 btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    </div>
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
@endpush
