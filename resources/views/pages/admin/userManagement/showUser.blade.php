@extends('layouts.app')

@section('content')
    <h1>Show user blade</h1>
    <table class="table">
        <tr>
            <td>User ID</td>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <td>Role</td>
            <td>{{ $user->getRole() }}</td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Registered</td>
            <td>{{ date('d-m-Y h:m:s', strtotime($user->created_at)) }}</td>
        </tr>
    </table>
    <a href="{{ route('user.edit', $user) }}" class="btn btn-primary">Edit btn</a>
@endsection