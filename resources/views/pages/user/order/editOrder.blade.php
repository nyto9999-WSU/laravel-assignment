@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role: {{ Auth::user()->roleName() }}</h1>
    <h1>editOrder.blade</h1>
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
                    <small>order.update</small>
                    <form action="{{ route('order.update', $order) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <!--TODO:This is example-->
                        <label for="extra_note">Extra_note</label>
                        <input type="text" name="extra_note" placeholder="{{ $order->extra_note }}">

                        <!--TODO:  code here-->
                        <button type="submit">Edit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
