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
                    <!-PUT|PATCH | order/{order}| order.update-->
                    <form action="{{ route('order.update', $order) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <label for="desc">Description</label>
                        <input type="text" name="desc" placeholder="{{ $order->desc }}">
                        <button type="submit">Edit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
