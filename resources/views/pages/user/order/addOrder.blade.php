@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role: {{ Auth::user()->getRole() }}</h1>
    <h1>addOrder.blade</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Create Order</h1>

                    <form action="{{ route('order.store') }}" method="post">
                        @csrf

                        {{-- name --}}
                        <label for="name">Name</label>
                        <input type="text" name="name">

                        {{-- email --}}
                        <label for="email">Email</label>
                        <input type="text" name="email">

                        {{-- mobile_number --}}
                        <label for="mobile_number">Mobile Number</label>
                        <input type="text" name="mobile_number">

                        {{-- no_of_unit --}}
                        <label for="no_of_unit">No. of Unit</label>
                        <input type="text" name="no_of_unit">

                        {{-- install_address --}}
                        <label for="install_address">Install Address</label>
                        <input type="text" name="install_address">

                        {{-- state --}}
                        <label for="state">State</label>
                        <input type="text" name="state">

                        {{-- suburb --}}
                        <label for="suburb">Suburb</label>
                        <input type="text" name="suburb">

                        {{-- postcode --}}
                        <label for="postcode">Postcode</label>
                        <input type="text" name="postcode">

                        {{-- prefer_date --}}
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="{{-- Style --}}" name="prefer_date" id="date"/>
                            <span class="input-group-append">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-calendar-check"></i>
                                </span>
                            </span>
                        </div>

                        {{-- prefer_time --}}
                        <label for="prefer_time">Prefer Time</label>
                        <input type="text" name="prefer_time">

                        {{-- domestic_commercial --}}
                        <label for="domestic_commercial">Domestic Commercial</label>
                        <input type="text" name="domestic_commercial">

                        {{-- extra_note --}}
                        <label for="extra_note">Extra Note</label>
                        <input type="text" name="extra_note">

                        {{-- Submit to order.store --}}
                        <button type="submit">order.store</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
            //在後端改FIXME:
            $('#datepicker').datepicker({format: 'yyyy/mm/dd'});
            $('#datepicker').datepicker("setDate", new Date());
    </script>
@endpush