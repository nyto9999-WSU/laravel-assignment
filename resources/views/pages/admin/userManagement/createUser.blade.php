@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>createUser.blade</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">


                <form action="{{ route('user.store') }}" method="post">
                    @csrf

                    <label for="name">Name</label>
                    <input type="text" name="name">

                    <select class="" name="role_id">
                        <option disabled selected value>Role</option>
                        <option value="1">User</option>
                        <option value="3">Technician</option>
                        <option value="2">Admin</option>
                    </select>

                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    </div>


    </div>
@endsection
