@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>editUser.blade</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">


                <form action="{{ route('user.updateProfile', $user) }}" method="post">
                    @csrf
                    @method('PATCH')

                    {{-- TODO: --}}
                    <label for="name">{{ $user->name }}</label>
                    <input type="text" name="name" placeholder="{{ $user->name }}">



                    <button type="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>
    </div>

    </div>


    </div>
@endsection
