@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Role: {{ Auth::user()->getRole() }}</h1>
                <h1>showOrder.blade</h1>
                <table class="table">

                    {{-- user_id --}}
                    <tr>
                        <td>ID</td>
                        <td>{{ $user->id }}</td>
                    </tr>
                    {{-- name --}}
                    <tr>
                        <td>Name</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    {{-- email --}}
                    <tr>
                        <td>email</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    {{-- created_at --}}
                    <tr>
                        <td>created_at</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>




                </table>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
