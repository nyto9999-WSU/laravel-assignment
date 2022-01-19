@extends('layouts.app')

@section('content')
    <div class="container">
       
        <div class="row justify-content-center">
            <div class="text-center">
                <p></p>
                    <h1>Client Profile</h1>
                <p>Please click on "Save" after making any changes</p>
            </div>
            <div class="col-md-8">
                <div class="card pt-2 pb-3" style="width: 100%">
                    <form action="{{ route('user.updateProfile', $user) }}" method="post">
                        @csrf
                        @method('PATCH')
                        
                        {{-- TODO: --}}
                        <div class="row" style="margin: 0">
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input class="form-control" id="first_name" type="text" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input class="form-control" id="last_name" type="text" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="phone">Phone Number</label>
                                <input class="form-control" id="phone" type="text" placeholder="Phone Number">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="email">Email ID</label>
                                <input class="form-control" id="email" type="text" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="state">State/Region</label>
                                <input class="form-control" id="state" type="text" placeholder="State/Region">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="postcode">Postcode</label>
                                <input class="form-control" id="postcode" type="text" placeholder="Postcode">
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
    </div>
    </div>
    </div>
@endsection
