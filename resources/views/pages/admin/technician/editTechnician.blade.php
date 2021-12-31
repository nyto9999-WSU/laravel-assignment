@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>technicians.blade</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">


                <form action="{{ route('technician.update', $technician) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <label for="name">{{ $technician->name }}</label>
                    <input type="text" name="name" placeholder="{{ $technician->name }}">

                    <button type="submit">Edit</button>
                </form>
            </div>
        </div>
        <div class="d-flex flex-row-reverse">
        </div>
    </div>

    </div>


    </div>
@endsection
