@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Title --}}
        <div class="row m-0 p-0">
            <h2 id="title" class="col-md-6 m-0 p-0"></h2>
            <h2 class="col-md-6 text-end m-0 p-0">Status: {{ ucfirst($job->status) }}</h2>
        </div>

        <hr class="my-2">

        <div class="col-12 shadow-sm px-1 rounded border border-2">
            <table class="table table-hover text-start mb-2 mt-1">

                @if (Auth::user()->isAdmin())
                    <th id="blue" class="text-white">
                        Aircon ID : {{ $job->aircon_id }}
                    </th>
                    <th id="blue" class="text-white text-end p-0">
                        <a href="{{ route('order.edit', ['order' => $order, 'job' => $job]) }}"
                            class=" btn btn-light text-dark m-1 py-1 fw-bold">Edit</a>
                    </th>
                @else
                    <th id="blue" colspan="2" class="text-white">
                        Aircon ID : {{ $job->aircon_id }}
                    </th>
                @endif

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
                <th colspan="2" class="text-white">
                    Job ID: {{ $job->id }}
                </th>

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

                {{-- prefer_date --}}
                <tr>
                    <td>Prefer Date</td>
                    <td class="text-danger fw-bold">
                        @if (!empty($job->prefer_date))
                            {{ date('d - M - Y', strtotime($job->prefer_date)) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                {{-- prefer_time --}}
                <tr>
                    <td>Prefer Time</td>
                    <td class="text-danger fw-bold">
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
                    @if (!empty($job->start_date))
                        <td class="text-primary fw-bold">
                            {{ date('d - M - Y', strtotime($job->start_date)) }}
                        </td>
                    @else
                        <td>
                            N/A
                        </td>
                    @endif
                </tr>

                {{-- start_time --}}
                <tr>
                    <td>Start Time</td>
                    @if (!empty($job->start_time))
                        <td class="text-primary fw-bold">
                            {{ $job->start_time }}
                        </td>
                    @else
                        <td>
                            N/A
                        </td>
                    @endif
                </tr>

                {{-- job_end_date --}}
                <tr>
                    <td>End Date</td>
                    @if (!empty($job->end_date))
                        <td class="text-success fw-bold">
                            {{ date('d - M - Y h:iA', strtotime($job->end_date)) }}
                        </td>
                    @else
                        <td>
                            N/A
                        </td>
                    @endif
                </tr>

                {{-- FIXME: --}}
                {{-- created_at --}}
                {{-- <tr>
                    <td>Requested at</td>
                    <td>{{ date('d - M - Y h:iA', strtotime($order->created_at)) }}</td>
                </tr>

                <tr>
                    <td>Assigned at</td>
                    <td>
                        @if (!empty($job->assigned_at))
                            {{ date('d - M - Y h:iA', strtotime($job->assigned_at)) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr> --}}
                {{-- status --}}
                <tr>
                    <td>Status</td>
                    <td id="status" class="text-capitalize fw-bold">{{ $job->status }}</td>
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
                                    <a href="{{ route('aircon.show', [$aircon, $order]) }}">
                                        Model: {{ $aircon->model_number }} / Serial:
                                        {{ $aircon->serial_number }}</a></a>
                                </li>
                            @empty

                            @endforelse
                        </ol>
                    </td>
                </tr>

                {{-- no.of unit --}}
                <tr>
                    <td>No. of Unit</td>
                    <td> <a href={{ route('aircon.showAll', ['id' => $job->aircon_id, $order]) }}>
                            {{ count($order->aircons) }} units see all
                        </a></td>
                </tr>

                <tr>
                    <td>Extra note</td>
                    <td>{{ $order->extra_note }}</td>
                </tr>

                <!--Owner info-->

                <th id="blue" colspan="2" class="text-white">
                    Owner Info
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
        switch ($('#status').html()) {
            case 'booked':
                $('#title').text('Requested Job');
                $('th').css('background-color', '#A33431');
                $('#status').css('color', '#A33431');
                break;

            case 'completed':
                $('#title').text('Completed Job');
                $('th').css("background-color", "#366B2C");
                $('#status').css('color', '#366B2C');
                break;

            default:
                $('#title').text('Assigned Job');
                $('th').css('background-color', '#005aa4');
                $('#status').css('color', '#005aa4');
                break
        }
    </script>
@endpush
