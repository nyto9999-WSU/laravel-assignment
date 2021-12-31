@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Role: {{ Auth::user()->getRole() }}</h1>
                <h1>showOrder.blade</h1>
                <table class="table">

                    {{-- order_id --}}
                    <tr>
                        <td>Order</td>
                        <td>{{ $order->id }}</td>
                    </tr>


                    {{-- model_number --}}
                    <tr>
                        <td>Model Number</td>
                        <td>
                            @forelse ($order->aircons as $aircon)
                                <li>
                                    <a
                                        href="{{ route('aircon.show', [$aircon, $order]) }}">{{ $aircon->model_number }}</a>
                                </li>
                            @empty

                            @endforelse
                        </td>
                    </tr>

                    {{-- domestic_commercial --}}
                    <tr>
                        <td>Domestic Commercial</td>
                        <td>{{ $order->domestic_commercial }}</td>
                    </tr>

                    <tr>
                        <td>Technician</td>
                        <td>N/A</td>
                    </tr>

                    {{-- extra_note --}}
                    <tr>
                        <td>Description</td>
                        <td>{{ $order->extra_note }}</td>
                    </tr>

                    {{-- status --}}
                    <tr>
                        <td>Status</td>
                        <td>{{ $order->status }}</td>
                    </tr>

                    {{-- name --}}
                    <tr>
                        <td>Owner</td>
                        <td>{{ $order->name }}</td>
                    </tr>

                    {{-- email --}}
                    <tr>
                        <td>Email Address</td>
                        <td>{{ $order->email }}</td>
                    </tr>

                    {{-- install_address --}}
                    <tr>
                        <td>Installation Address</td>
                        <td>{{ $order->install_address }}</td>
                    </tr>

                    {{-- state --}}
                    <tr>
                        <td>State</td>
                        <td>{{ $order->state }}</td>
                    </tr>

                    {{-- suburb --}}
                    <tr>
                        <td>Suburb</td>
                        <td>{{ $order->suburb }}</td>
                    </tr>

                    {{-- postcode --}}
                    <tr>
                        <td>Postcode</td>
                        <td>{{ $order->postcode }}</td>
                    </tr>

                    <tr>
                        <td>Start Date</td>
                        <td>
                            @if (!empty($order->job_start_date))
                                {{ $order->job_start_date }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>End Date</td>
                        <td>
                            @if (!empty($order->job_end_date))
                                {{ $order->job_end_date }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>

                    {{-- created_at --}}
                    <tr>
                        <td>Requested Date</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>

                    <tr>
                        <td>Assigned at</td>
                        <td>
                            @if (!empty($order->assigned_at))
                                {{ $order->assigned_at }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>



                </table>

                <a href="{{ route('order.edit', $order) }}" class="btn btn-primary">order.edit</a>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
