@extends('layouts.app')

@section('content')
<div class="container">
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
                    <h1>Add aircon</h1>
                    <form action="{{ route('aircon.store', $order) }}" method="post">
                        @csrf
                            <label for="type">air-con type</label>
                            <input type="text" name="type">
                            <button type="submit">submit</button>
                    </form>

                    @forelse ($order->aircons as $aircon)
                        <li>{{ $aircon->type }}</li>
                    @empty
                        <h1>no data</h1>
                    @endforelse



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
