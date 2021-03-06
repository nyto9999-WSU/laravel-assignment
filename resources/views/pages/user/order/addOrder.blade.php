@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center">
                <h2>Priority Service and Maintenace Booking</h2>
                <p class="lead">Please provide your correct contact number and preferred date. Once you click the
                    submit button, the system will ask for your air-condiction information</p>
            </div>

            {{-- error msg --}}
            @if ($errors->any())
                <div class="col-12 alert alert-danger">
                    <ul class="m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('order.store') }}" method="post">
                @csrf

                {{-- name --}}
                <div class="col-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ Auth::user()->name ?? @$orderRecord['name'] }}">



                </div>
                {{-- email --}}
                <div class="col-12">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email"
                        value="{{ Auth::user()->email ?? @$orderRecord['email'] }}">

                </div>

                {{-- mobile_number --}}
                <div class="col-12">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" name="mobile_number"
                        value="{{ Auth::user()->mobile_number ?? @$orderRecord['mobile_number'] }}">

                </div>

                {{-- address --}}
                <div class="col-12">
                    <label for="ddress" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address"
                        value="{{ @$orderRecord['address'] }}">

                </div>

                <div class="row">

                    {{-- state --}}
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" name="state" id="state">
                            <option value="{{ Auth::user()->state ?? @$orderRecord['state'] }}">
                                {{ Auth::user()->state ?? (@$orderRecord['state'] ?? 'Choose') }}</option>
                            <option>NSW</option>
                            <option>Victoria</option>
                            <option>Queensland</option>
                            <option>South Australia</option>
                            <option>Western Australia</option>
                            <option>Tasmania</option>
                            <option>Northern Territory</option>
                            <option>Australian Capital Territory</option>
                        </select>

                    </div>


                    {{-- suburb --}}
                    <div class="col-md-4">
                        <label for="suburb" class="form-label">Suburb</label>
                        <input type="text" class="form-control" name="suburb" value="{{ @$orderRecord['suburb'] }}">

                    </div>


                    {{-- postcode --}}
                    <div class="col-md-4">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" name="postcode"
                            value="{{ Auth::user()->postcode ?? @$orderRecord['postcode'] }}">

                    </div>
                </div>

                {{-- extra_note --}}
                <div class="col-lg-12">
                    <div class="description">
                        <label for="extra_note" class="form-label">Extra note(optional)</label>

                        <textarea class="form-control" name="extra_note" id="extra_note" cols="30" rows="2"
                            placeholder="example: 2 dogs in house"></textarea>

                        <hr class="my-4">
                    </div>
                </div>

                {{-- Submit to order.store --}}
                <button type="submit" id="blue" class="w-100 btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div>

@endsection
