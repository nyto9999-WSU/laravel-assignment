@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">Request Details</h2>
        <div class="col-12 shadow-sm px-1 rounded border border-2">
            <table class="table table-hover text-start mb-2 mt-1">

                <th id="blue" class="text-white">
                    Aircon ID : {{ $job->aircon_id }}
                </th>

                <th id="blue" class="text-white text-end">
                    <a href="{{ route('order.edit', ['order' => $order, 'job' => $job]) }}"
                        class=" btn btn-light text-dark">Edit</a>
                </th>
                <tr>
                    <td>Install Address</td>
                    <td>{{ $job->install_address }}</td>
                </tr>
                <tr>
                    <td>Model Number</td>
                    <td>{{ $job->model_number }}</td>
                </tr>
                <tr>
                    <td>Serial Number</td>
                    <td>{{ $job->serial_number }}</td>
                </tr>
                <tr>
                    <td>Equipment Type</td>
                    <td>{{ $job->equipment_type }}</td>
                </tr>
                <tr>
                    <td>Service Type</td>
                    <td>{{ $job->domestic_commercial }}</td>
                </tr>
                <tr>
                    <td>Issue</td>
                    <td>{{ $job->issue }}</td>
                </tr>

                {{-- job header --}}
                <th id="blue" colspan="2" class="text-white">
                    Job Details
                </th>

                {{-- prefer_date --}}
                <tr>
                    <td>Prefer Date</td>
                    <td>
                        @if (!empty($job->prefer_date))
                            {{ date('d-m-Y', strtotime($job->prefer_date)) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                {{-- prefer_time --}}
                <tr>
                    <td>Prefer Time</td>
                    <td>
                        @if (!empty($job->prefer_time))
                            {{ $job->prefer_time }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                {{-- start_date --}}
                <tr>
                    <td>Start Date</td>
                    <td>
                        @if (!empty($job->start_date))
                            {{ date('d-m-Y', strtotime($job->start_date)) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                {{-- job_end_date --}}
                <tr>
                    <td>End Date</td>
                    <td>
                        @if (!empty($job->end_date))
                            {{ date('d-m-Y', strtotime($job->end_date)) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                {{-- technician --}}
                <tr>
                    <td>Technician</td>
                    <td>
                        @if (!empty($job->tech_name))
                            {{ $job->tech_name }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                {{-- created_at --}}
                <tr>
                    <td>Requested at</td>
                    <td>{{ date('d-m-Y h:m:s', strtotime($order->created_at)) }}</td>
                </tr>

                {{-- assigned_at --}}
                <tr>
                    <td>Assigned at</td>
                    <td>
                        @if (!empty($job->assigned_at))
                            {{ date('d-m-Y h:m:s', strtotime($job->assigned_at)) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
                {{-- status --}}
                <tr>
                    <td>Status</td>
                    <td id="status">{{ $job->status }}</td>
                </tr>

                {{-- order header --}}
                <th id="blue" colspan="2" class="text-white">
                    Order Details
                </th>

                {{-- model_number --}}
                <tr>
                    <td>Model Number</td>
                    <td>
                        <ol class="p-0 m-0 ms-3">
                        @forelse ($order->aircons as $aircon)
                            <li>
                                <a href="{{ route('aircon.show', [$aircon, $order]) }}">{{ $aircon->model_number }}</a>
                            </li>

                            @empty

                            @endforelse
                        </ol>
                    </td>
                </tr>

                {{-- serial_number --}}
                <tr>
                    <td>Serial Number</td>
                    <td>
                        <ol class="p-0 m-0 ms-3">
                        @forelse ($order->aircons as $aircon)
                            <li>
                                <a
                                    href="{{ route('aircon.show', [$aircon, $order]) }}">{{ $aircon->serial_number }}</a>
                            </li>
                        @empty

                        @endforelse
                        </ol>
                    </td>
                </tr>

                {{-- no.of unit --}}
                <tr>
                    <td>No. of Unit</td>
                    <td>{{ count($order->aircons) }}</td>
                </tr>

                <!--Owner info-->

                <th id="blue" colspan="2" class="text-white">
                    Owner Info
                    {{-- edit button --}}

                </th>

                {{-- name --}}
                <tr>
                    <td>Name</td>
                    <td>{{ $order->name }}</td>
                </tr>

                {{-- email --}}
                <tr>
                    <td>Email Address</td>
                    <td>{{ $order->email }}</td>
                </tr>

                {{-- mobile number --}}
                <tr>
                    <td>Mobile Number</td>
                    <td>{{ $order->mobile_number }}</td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>{{ $order->address }}</td>
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

            </table>

        </div>

    </div>

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        switch($('#status').html()) {
            case 'booked':
                $('th').css('background-color', '#B83520');
                break;
            case 'completed':
                $('th').css("background-color", "#366B2C");
                break;
            default:
                $('th').css('background-color', '#005aa4');
                break
        }
    </script>
@endpush