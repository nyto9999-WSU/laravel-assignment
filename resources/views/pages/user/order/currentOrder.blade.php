@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>currentOrder.blade</h1>
        <div class="row justify-content-center">
                <table class="table">
                    <tr>
                        <th>Order</th>
                        <th style="">Model</th>
                        <th style="">show</th>
                        <th style="width: 13.2%">Requested Date</th>
                        <th style="width: 12.2%">Assigned Date</th>
                        <th style="width: 12.2%">Completed Date</th>
                        <th>Technician</th>
                        <th>Status</th>
                        <th>Cancel</th>
                    </tr>
                    @forelse ($orders as $order)
                        <tr>
                            <td>
                                <a href="{{ route('order.show', $order) }}">{{ $order->id }}</a>
                            </td>
                            <td>
                                @forelse ($order->aircons as $aircon)
                                    <li>
                                        <a href={{ route('aircon.show', [$aircon, $order]) }}>
                                            {{ $aircon->model_number }}
                                        </a>
                                    </li>
                                @empty
                                    N/A
                                @endforelse
                                {{-- TODO:show all aircon details --}}
                                <a href="">all</a>
                            </td>
                            <td>
                                <span class="position-relative">
                                    all models info
                                    <span class="ms-3 position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $order->aircons->count() }}
                                    </span>
                                </span>
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
