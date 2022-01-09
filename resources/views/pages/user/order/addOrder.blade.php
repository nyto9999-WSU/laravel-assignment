@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="py-3 text-center">
                <h2>Priority Service and Maintenace Booking</h2>
                <p class="lead">Please provide your correct contact number and preferred date. Once you click the
                    submit button, the system will ask for your air-condiction information</p>
            </div>

            <form action="{{ route('order.store') }}" method="post">
                @csrf

                {{-- name --}}
                <div class="col-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" value="">
                    <div class="invalid-feedback">
                        Valid name is required.
                    </div>
                </div>

                {{-- email --}}
                <div class="col-12">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                {{-- mobile_number --}}
                <div class="col-12">
                    <label for="mobile_number" class="form-label">Mobile Number</label>
                    <input type="number" class="form-control" name="mobile_number" id="mobile" placeholder="0632132131">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                {{-- no_of_unit --}}
                <div class="col-12">

                    <label for="no_of_unit" class="form-label">No. of Unit </label>
                    <input type="text" class="form-control" name="no_of_unit" id="model"
                        placeholder="Please advise the number of units">

                </div>
                <div class="invalid-feedback">
                    error msg
                </div>


                {{-- install_address --}}
                <div class="col-12">
                    <label for="install_address" class="form-label">Install Address</label>
                    <input type="text" class="form-control" name="install_address" id="address"
                        placeholder="1234 Main St">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="row">
                    {{-- state --}}
                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" name="state" id="state">
                            <option value="">Choose...</option>
                            <option>NSW</option>
                            <option>Victoria</option>
                            <option>Queensland</option>
                            <option>South Australia</option>
                            <option>Western Australia</option>
                            <option>Tasmania</option>
                            <option>Northern Territory</option>
                            <option>Australian Capital Territory</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>


                    {{-- suburb --}}
                    <div class="col-md-4">
                        <label for="suburb" class="form-label">Suburb</label>
                        <input type="text" class="form-control" name="suburb" id="Suburb" placeholder="">
                        <div class="invalid-feedback">
                            Suburb required.
                        </div>
                    </div>


                    {{-- postcode --}}
                    <div class="col-md-4">
                        <label for="postcode" class="form-label">Postcode</label>
                        <input type="text" class="form-control" name="postcode" id="postcode" placeholder="">
                        <div class="invalid-feedback">
                            Postcode required.
                        </div>
                    </div>
                </div>


                <hr class="my-4">

                <div class="row">
                    {{-- prefer_date --}}
                    <div class="col-md-4">
                        <label for="prefer_date">Prefer Date</label>
                        <input type="text" class="" id="datepicker" name="prefer_date">
                    </div>


                    {{-- prefer_time --}}
                    <div class="col-md-4">

                        <label for="prefer_time" class="form-label">Prefer Time</label>
                        <select class="form-select" name="prefer_time" id="prefer_time">
                            <option value="">Choose...</option>
                            <option>Morning</option>
                            <option>Afternoon</option>
                            <option>Evening</option>
                        </select>

                    </div>


                    {{-- domestic_commercial --}}
                    <div class="col-md-4">
                        <label for="domestic_commercial" class="form-label">Domestic / Commercial</label>
                        <select class="form-select" name="domestic_commercial" id="domestic_commercial">
                            <option value="">Choose...</option>
                            <option>Domestic</option>
                            <option>Commercial</option>
                        </select>
                    </div>
                </div>



                {{-- extra_note --}}
                <div class="col-lg-12">
                    <div class="description">
                        <label for="extra_note" class="form-label">Extra note</label>

                        <textarea class="form-control" name="extra_note" id="extra_note" cols="30" rows="2"
                            placeholder="example: 2 dogs in house"></textarea>

                        <hr class="my-4">
                    </div>
                </div>

                {{-- Submit to order.store --}}
                <button type="submit" class="w-100 btn btn-primary">Submit</button>
            </form>
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
        //在後端改日期匹配mysql格式FIXME:
        $('#datepicker').datepicker("setDate", new Date());
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: '0'
        });
    </script>
@endpush
