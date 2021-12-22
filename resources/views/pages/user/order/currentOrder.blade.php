@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role: {{ Auth::user()->roleName() }}</h1>
    <h1>currentOrder.blade</h1>

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
                        @if ($order->aircons->count())
                            <tr>
                                <th>Order</th>
                                <th>Owner</th>
                                <th>Extra Note</th>
                                <th>Prefer Date</th>
                                <th>Air-con Type</th>
                                <th>E Dit</th>
                                <th>Cancel</th>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{ route('order.edit', $order) }}">{{ $order->id }}</a>
                                </td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->extra_note }}</td>
                                <td>{{ $order->prefer_date }}</td>
                                <td>
                                    <small>aircon.show</small>
                                    @forelse ($order->aircons as $aircon)
                                        <li>
                                            <a href={{ route('aircon.show', [$aircon,$order]) }}>
                                                {{ $aircon->equipment_type }}
                                            </a>
                                        </li>
                                    @empty
                                            <h1>nodata</h1>
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ route('order.edit', $order) }}" class="btn btn-primary">order.edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('order.destroy', $order) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">order.destory</button>
                                    </form>
                                </td>
                            </tr>
                        @endif

                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
