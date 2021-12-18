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
                    <table class="table">
                        @forelse ($orders as $order)
                            <tr>
                                <th>Order</th>
                                <th>Owner</th>
                                <th>Description</th>
                                <th>Air-con Type</th>
                            </tr>
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->desc }}</td>
                                <td>
                                        @forelse ($order->aircons as $aircon)
                                            <li>
                                                {{ $aircon->type }} <br>
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
