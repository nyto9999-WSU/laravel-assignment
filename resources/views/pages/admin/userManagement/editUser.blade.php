@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row g-2 mx-2 justify-content-center">
            <div class="text-center">
                <h1>Client Profile</h1>
                <p>Please click on "Save" after making any changes</p>
            </div>
            @if (session()->has('message'))
                <div class="col-md-8 alert alert-success">
                    <p class="msg"> {{ session()->get('message') }}</p>
                </div>
            @endif
            <div class="col-md-8">
                <div class="card pt-2 pb-3" style="width: 100%">
                    <form action="{{ route('user.updateProfile', $user) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="row" style="margin: 0">
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input class="form-control" id="first_name" type="text" name="name"
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="phone">Phone Number</label>
                                <input class="form-control" id="phone" name="mobile_number" type="text"
                                    value="{{ $user->mobile_number }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="email">Email ID</label>
                                <input class="form-control" id="email" type="text" name="email"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="state">State</label>
                                <select class="form-select" name="state" id="state">
                                    <option value="{{ $user->state }}">{{ $user->state }}</option>
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
                            <div class="col-md-6 mt-2">
                                <label for="postcode">Postcode</label>
                                <input class="form-control" id="postcode" name="postcode" type="text"
                                    value="{{ $user->postcode }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <button class="btn btn-primary form-control" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.alert-success').fadeIn().delay(1000).fadeOut();
        });
    </script>
@endpush
