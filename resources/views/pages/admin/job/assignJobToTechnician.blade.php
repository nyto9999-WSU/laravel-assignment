@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>assignJobToTechnician.blade</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">

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
                    {{-- mobile_number --}}
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $order->mobile_number }}</td>
                    </tr>

                    {{-- prefer_time --}}
                    <tr>
                        <td>Prefer Time</td>
                        <td>{{ $order->prefer_time }}</td>
                    </tr>

                    {{-- prefer_date --}}
                    <tr>
                        <td>Prefer Date</td>
                        <td>{{ $order->prefer_date }}</td>
                    </tr>

                </table>

                <form action="{{ route('job.store', $order) }}" method="post">
                    @csrf
                        <label for="date">start date</label>
                        <input type="text" name="date">
                        <label for="time">start time</label>
                        <input type="text" name="time">
                        @forelse ($technicians as $t)
                            <h1>{{ $t->name }}</h1>
                        @empty

                        @endforelse

                        <button type="submit">submit</button>
                </form>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
