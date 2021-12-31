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
                                    <a href="{{ route('aircon.show', [$aircon, $order]) }}">
                                        {{ $aircon->model_number }}
                                    </a>
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
                <form action="" method="post">
                    {{-- techician_id --}}

                </form>


                <form action="{{ route('job.store', $order) }}" method="post">
                    @csrf

                    {{-- start --}}
                    <label for="job_start_date">Start Date</label>
                    <input type="text" class="" id="datepicker" name="job_start_date">

                    <select class="tech_id" name="tech_id">
                        <option disabled selected value>Technician</option>
                        @forelse ($technicians as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @empty

                        @endforelse
                    </select>

                    <button type="submit">submit</button>
                </form>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        //在後端改日期匹配mysql格式FIXME:
        $('#datepicker').datepicker("setDate", new Date());
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: '0'
        });
    </script>
@endpush
