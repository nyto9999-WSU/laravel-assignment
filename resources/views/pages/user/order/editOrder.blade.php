@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>editOrder.blade</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>order.update</h1>

                {{-- TODO: change current input type --}}
                <form action="{{ route('order.update', $order) }}" method="post">
                    @csrf
                    @method('PATCH')
                    {{-- name --}}
                    <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="{{ $order->name }}" value="" >
                <div class="invalid-feedback">
                  Valid name is required.
                </div>
              </div>

                    {{-- email --}}
                    <div class="col-12">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="{{ $order->email }}" >
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>
                    

                    {{-- mobile_number --}}
                    <div class="col-12">
                <label for="mobile_number" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" name="mobile_number" id="mobile" placeholder="{{ $order->mobile_number }}" >
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>
                    

                    {{-- no_of_unit --}}
                    <div class="col-12">

                <label for="no_of_unit" class="form-label">No. of Unit </label>
                <input type="text" class="form-control" name="no_of_unit" id="model" placeholder="{{ $order->no_of_unit }}" >

              </div>
              <div class="invalid-feedback">
              error msg
              </div>
                    

                    {{-- install_address --}}
                    <div class="col-12">
                <label for="install_address" class="form-label">Install Address</label>
                <input type="text" class="form-control" name="install_address" id="address" placeholder="{{ $order->install_address }}" >
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
              </div>
                    

                    {{-- state --}}
                    <div class="col-md-4">
                <label for="state" class="form-label">State</label>
                <select class="form-select" name="state" id="state" placeholder="{{ $order->state }}">
                  <option value="">Choose...</option>
                  <option>NSW</option>
                  <option>Sydney</option>
                  <option>California</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
                    

                    {{-- suburb --}}
                    <div class="col-md-4">
                <label for="suburb" class="form-label">Suburb</label>
                <input type="text" class="form-control" name="suburb" id="Suburb" placeholder="{{ $order->suburb }}" >
                <div class="invalid-feedback">
                  Suburb required.
                </div>
              </div>
                    

                    {{-- postcode --}}
                    <div class="col-md-4">
                <label for="postcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="{{ $order->postcode }}" >
                <div class="invalid-feedback">
                  Postcode required.
                </div>
              </div>
                    

                    {{-- prefer_date --}}
                    <label for="prefer_date">Prefer Date</label>
                    <input type="text" class="" id="datepicker" name="prefer_date" placeholder="{{ $order->prefer_date }}">
                    

                    {{-- prefer_time --}}
                    <div class="col-md-4">
                <b class="">Perfer time</b>
                <div class="form-check">
                  <input id="credit" name="prefer_time" type="radio" class="form-check-input" checked >
                  <label class="form-check-label" for="credit">Morning</label>
                </div>

                <div class="form-check">
                  <input id="debit" name="prefer_time" type="radio" class="form-check-input" >
                  <label class="form-check-label" for="debit">Afternoon</label>
                </div>

                <div class="form-check">
                  <input id="paypal" name="prefer_time" type="radio" class="form-check-input" >
                  <label class="form-check-label" for="paypal">Evening</label>
                </div>
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
                    

                    {{-- extra_note --}}
                    <div class="col-lg-12">
                <div class="description">
                  <label for="extra_note" class="form-label">Extra note</label>

                  <textarea class="form-control" name="extra_note" id="extra_note" cols="30" rows="2" placeholder="{{ $order->extra_note }}" ></textarea>



              <hr class="my-4">
                    

              <button type="save" class="w-100 btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
