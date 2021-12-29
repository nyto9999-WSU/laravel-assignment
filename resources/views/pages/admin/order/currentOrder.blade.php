@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>currentOrder.blade(admin)</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    @forelse ($orders as $order)
                        <tr>
                            <th>Assign</th>
                            <th>Order</th>
                            <th>Model</th>
                            <th>No. of unit</th>
                            <th>Customer</th>
                            <th>Unit Address</th>
                            <th>Phone</th>
                            <th>Requested Date</th>
                            <th>Preferred Date</th>
                            <th>Type</th>
                            <th>Extra Note</th>
                        </tr>
                        <tr>
                            {{-- assign button --}}
                            <td>
                                <a href="{{ route('job.assignJobToTechnician' , $order->id) }}" class="btn btn-primary">
                                    <i class="bi bi-pen"></i>
                                </a>
                            </td>

                            {{-- order_id --}}
                            <td>
                                <a href={{ route('order.show', $order->id) }}>{{ $order->id }}</a>
                            </td>

                            {{-- model_number --}}
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
                                {{-- TODO: all aircons --}}
                                <li>All</li>
                            </td>

                            {{-- no_of_unit --}}
                            <td>{{ $order->no_of_unit }}</td>

                            {{-- name --}}
                            <td>{{ $order->name }}</td>

                            {{-- install_address --}}
                            <td>{{ $order->install_address }}</td>

                            {{-- mobile_number --}}
                            <td>{{ $order->mobile_number }}</td>

                            {{-- created_at --}}
                            <td>{{ $order->created_at }}</td>

                            {{-- prefer_date --}}
                            <td>{{ $order->prefer_date }}</td>

                            {{-- domestic_commercial --}}
                            <td>{{ $order->domestic_commercial }}</td>

                            {{-- extra_note --}}
                            <td>{{ $order->extra_note }}</td>
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
