@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>editOrder.blade</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <small>order.update</small>
                <form action="{{ route('order.update', $order) }}" method="post">
                    @csrf
                    @method('PATCH')
                    {{-- name --}}
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="{{ $order->name }}">

                    {{-- email --}}
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="{{ $order->email }}">

                    {{-- mobile_number --}}
                    <label for="mobile_number">Mobile Number</label>
                    <input type="text" name="mobile_number" placeholder="{{ $order->mobile_number }}">

                    {{-- no_of_unit --}}
                    <label for="no_of_unit">No. of Unit</label>
                    <input type="text" name="no_of_unit" placeholder="{{ $order->no_of_unit }}">

                    {{-- install_address --}}
                    <label for="install_address">Install Address</label>
                    <input type="text" name="install_address" placeholder="{{ $order->install_address }}">

                    {{-- state --}}
                    <label for="state">State</label>
                    <input type="text" name="state" placeholder="{{ $order->state }}">

                    {{-- suburb --}}
                    <label for="suburb">Suburb</label>
                    <input type="text" name="suburb" placeholder="{{ $order->suburb }}">

                    {{-- postcode --}}
                    <label for="postcode">Postcode</label>
                    <input type="text" name="postcode" placeholder="{{ $order->postcode }}">

                    FIXME:
                    {{-- prefer_date --}}
                    <label for="prefer_date">Prefer Date</label>
                    <input type="text" class="" id="datepicker" name="prefer_date" placeholder="{{ $order->prefer_date }}">

                    {{-- prefer_time --}}
                    <label for="prefer_time">Prefer Time</label>
                    <input type="text" name="prefer_time" placeholder="{{ $order->prefer_time }}">

                    {{-- domestic_commercial --}}
                    <label for="domestic_commercial">Domestic Commercial</label>
                    <input type="text" name="domestic_commercial" placeholder="{{ $order->domestic_commercial }}">

                    {{-- extra_note --}}
                    <label for="extra_note">Extra_note</label>
                    <input type="text" name="extra_note" placeholder="{{ $order->extra_note }}">

                    <button type="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
