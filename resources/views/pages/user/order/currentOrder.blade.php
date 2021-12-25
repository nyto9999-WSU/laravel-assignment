@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>currentOrder.blade</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <table class="table">
                    @forelse ($orders as $order)
                        <tr>
                            <th>Order</th>
                            <th>Model</th>
                            <th>Requested Date</th>
                            <th>Assigned Date</th>
                            <th>Completed Date</th>
                            <th>Technician</th>
                            <th>Status</th>
                            <th>Cancel</th>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('order.edit', $order) }}">{{ $order->id }}</a>
                            </td>
                            <td>
                                @forelse ($order->aircons as $aircon)
                                    <li>
                                        <a href={{ route('aircon.show', [$aircon, $order]) }}>
                                            {{ $aircon->id }}
                                        </a>
                                    </li>
                                @empty
                                    N/A
                                @endforelse
                                {{--TODO: all aircons --}}
                                <li>All</li>
                            </td>
                            {{-- Requested date --}}
                            <td>{{ $order->prefer_date }}</td>
                            {{-- Assigned date --}}
                            <td>N/A</td>
                            {{-- Completed date --}}
                            <td>N/A</td>
                            {{-- Technician --}}
                            <td>N/A</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <form action="{{ route('order.destroy', $order) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">order.destory</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <h1>No Data</h1>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
