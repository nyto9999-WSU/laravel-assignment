@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>order.update</h1>
            <div class="col-md-8">
                <form action="{{ route('order.update', $order) }}" method="post">
                    @csrf
                    @method('PATCH')

                    {{-- name --}}
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $order->name }}">
                        <div class="invalid-feedback">
                            Valid name is required.
                        </div>
                    </div>

                    {{-- email --}}
                    <div class="col-12">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $order->email }}">

                    </div>

                    {{-- mobile_number --}}
                    <div class="col-12">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control" name="mobile_number" id="mobile"
                            value="{{ $order->mobile_number }}">
                    </div>

                    {{-- address --}}
                    <div class="col-12">
                        <label for="install_address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="ddress" id="install_address"
                            value="{{ $job->install_address }}">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="row">
                        {{-- prefer_date --}}
                        <div class="col-md-6">

                            <label for="prefer_date">Prefer Date</label>
                            <input type="text" class="form-control" id="datepicker" name="prefer_date"
                                value="{{ date('d-m-Y', strtotime($job->prefer_date)) }}">
                        </div>
                        <div class="col-md-6">

                            {{-- prefer_time --}}
                            <label for="prefer_time">Prefer Time</label>
                            <select class="form-select w-100" name="prefer_time">
                                <option value="">{{ $job->prefer_time }}</option>
                                <option>Morning</option>
                                <option>Afternoon</option>
                                <option>Evening</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">
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

                            {{-- prefer_time --}}
                            <label for="prefer_time-time">Start Time</label>
                            <select class="form-select w-100" name="prefer_time">
                                <option value="">{{ $job->start_time }}</option>
                                <option>Morning</option>
                                <option>Afternoon</option>
                                <option>Evening</option>
                            </select>
                        </div>
                    </div>

                    {{-- domestic_commercial --}}
                    <div class="col-md-12">
                        <label for="domestic_commercial" class="form-label">Domestic / Commercial</label>
                        <select class="form-select" name="domestic_commercial" id="domestic_commercial">
                            <option value="">{{ $job->domestic_commercial }}</option>
                            <option>Domestic</option>
                            <option>Commercial</option>
                        </select>
                    </div>

                    {{-- extra_note --}}
                    <div class="col-lg-12">
                        <div class="description">
                            <label for="extra_note" class="form-label">Extra note</label>
                            <textarea class="form-control" name="extra_note" id="extra_note" cols="30"
                                rows="2">{{ $order->extra_note }}</textarea>

                            <hr class="my-4">
                            <button type="save" class="w-100 btn btn-primary">Save</button>
                        </div>
                    </div>
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
