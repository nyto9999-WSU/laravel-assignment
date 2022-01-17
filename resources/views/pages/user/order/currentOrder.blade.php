@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>currentOrder.blade</h1>
        <div class="row g-2">

            <h2 class="text-center">Service Request History</h1>
                <input type="text" id="search" class="form-control" placeholder="Search request">
                <table class="table table-hover">
                    <thead class="text-black text-wrap">
                        <tr>
                            <th>Job ID</th>
                            <th style="">Model</th>
                            <th style="">Serial</th>
                            <th style="">Requested Date</th>
                            <th style="">Assigned Date</th>
                            <th style="">Completed Date</th>
                            <th>Technician</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="current_orders">
                        @forelse ($orders as $order)
                            @forelse ($order->jobs as $job)
                                <tr>

                                    {{-- job-id --}}
                                    <td>
                                        <a href="{{ route('job.show', $job) }}">{{ $job->id }}</a>
                                    </td>
                                    {{-- model_number --}}
                                    <td>
                                        <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                            {{ $job->model_number }}
                                        </a>
                                        <a href="{{ route('aircon.showAll', [$order]) }}" class="position-relative">
                                            all
                                        </a>
                                    </td>
                                    {{-- serial_number --}}
                                    <td>
                                        <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                            {{ $job->serial_number }}
                                        </a>
                                        <a href="{{ route('aircon.showAll', [$order]) }}" class="position-relative">
                                            all
                                        </a>
                                    </td>

                                    {{-- Requested date --}}
                                    <td>{{ date('d-m-Y', strtotime($job->prefer_date)) }}</td>

                                    {{-- job_start_date --}}
                                    <td>
                                        @if (!empty($job->start_date))
                                            {{ $job->start_date }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    {{-- job_end_date --}}
                                    <td>
                                        @if (!empty($job->end_date))
                                            {{ $job->end_date }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>
                                        @if (!empty($job->tech_name))
                                            {{ $job->tech_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td class="text-capitalize">{{ $job->status }}</td>

                                </tr> 
                            @empty

                            @endforelse

                        @empty
                            <h1>No Data</h1>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/pages/order/search-request-history',
                data: {
                    's': $value,
                    status: 'Booked'
                },
                success: function(data) {
                    // console.log(data);
                    $('#current_orders').html(data.html);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>

@endsection
