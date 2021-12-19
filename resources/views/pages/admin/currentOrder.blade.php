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
                    <table class="table">
                        @forelse ($orders as $order)
                            <tr>
                                <th>Order</th>
                                <th>Owner</th>
                                <th>Description</th>
                                <th>Air-con Type</th>
                            </tr>
                            <tr>
                                <td><a href={{ route('order.show', $order->id) }}>{{ $order->id }}</a></td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->desc }}</td>
                                <td>
                                        @forelse ($order->aircons as $aircon)
                                            <li>
                                                <a href={{ route('aircon.show', [$aircon,$order]) }}>{{ $aircon->type }}</a>
                                            </li>
                                        @empty

                                        @endforelse
                                </td>

                            </tr>
                        @empty
                            <h1>no data</h1>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
