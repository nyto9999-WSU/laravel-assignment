@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>Order created</h1>
        <a href="{{ route('order.index') }}" id="blue" class="btn text-white fw-bold">See Request History</a>
    </div>
@endsection

