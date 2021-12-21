@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role: {{ Auth::user()->role }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Create Order</h1>

                    TODO:Fill #8 all data based on our client-request-form
                    <form action="{{ route('order.store') }}" method="post">
                        @csrf
                            <label for="desc">description</label>
                            <input type="text" name="desc">
                            //TODO: here
                            <button type="submit">submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
