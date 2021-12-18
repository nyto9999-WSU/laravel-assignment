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

                    {{-- @forelse ($orders as $order)

                        <li>
                            Order ID: {{ $order->id }}
                        </li>
                        <li>
                            Order Owner: {{ $order->name }}
                        </li>
                        <li>
                            Order air-con: {{ $order->type }}
                        </li>
                        <hr>
                    @empty

                    @endforelse --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
