@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row g-2 mx-2">
            <div class="col-3 mb-3">
                <h2 class="pb-0">User Profile</h2>
                    <small>the user information is shown in this page</small>
            </div>

            <div class="col-6">

            </div>

            <div class="col-3 mt-3">

            </div>
            <div class="col-md-12 border shadow-sm rounded border-2 p-1">
                <div class="w-100" id="blue">
                    <p class="fw-bold text-light p-2">Account Info</p>
                </div>
                <table class="table user-table">
                    <tbody>
                        <tr>
                            <th>User ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ $user->getRole() }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $user->mobile_number }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td>{{ $user->state }}</td>
                        </tr>
                        <tr>
                            <th>Postcode</th>
                            <td>{{ $user->postcode }}</td>
                        </tr>
                        <tr>
                            <th>Registered</th>
                            <td>{{ date('d-M-Y h:m:s', strtotime($user->created_at)) }}</td>
                        </tr>

                    </tbody>
                </table>
                <div class="d-grid mt-4">
                    <a href="{{ route('user.edit', $user) }}" id="blue" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
