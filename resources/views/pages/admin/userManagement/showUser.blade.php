@extends('layouts.app')

@section('content')
    <h2 class="text-center">User Profile</h2>
    <div class="row justify-content-center">
        <div class="col-md-10 border shadow-sm rounded border-2 p-1">
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
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
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
@endsection