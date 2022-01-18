@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row g-2">

            <h2 class="text-center">Service Request History</h1>
                <input type="text" id="search" class="form-control" placeholder="Search request">
                <table class="table table-hover">
                    <thead class="text-black text-wrap">
                        <tr>
                            <th>Job ID</th>
                            <th style="">Model/Serial</th>
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
                                        <li>
                                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                                Model: {{ $job->model_number }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                                Serial: {{ $job->serial_number }}
                                            </a>
                                        </li>
                                    </td>

                                    {{-- Requested date --}}
                                    <td class="text-danger fw-bold">
                                        {{ date('d-M-Y', strtotime($order->created_at)) }}
                                    </td>

                                    {{-- job_start_date --}}
                                    @if (!empty($job->start_date))
                                        <td class="text-primary fw-bold">
                                            {{ date('d-M-Y', strtotime($job->start_date)) }}
                                        </td>
                                    @else
                                        <td>
                                            N/A
                                        </td>
                                    @endif

                                    {{-- job_end_date --}}
                                    @if (!empty($job->end_date))
                                        <td class="text-success fw-bold">
                                            {{ date('d-M-Y', strtotime($job->end_date)) }}
                                        </td>
                                    @else
                                        <td>
                                            N/A
                                        </td>
                                    @endif

                                    <td>
                                        @if (!empty($job->tech_name))
                                            {{ $job->tech_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td class="text-capitalize" id="status">{{ $job->status }}</td>

                                </tr>
                            @empty

                            @endforelse

                        @empty
                            <tr>
                                <td colspan="10" class=" text-center fw-bold">
                                    No Result
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
                    status: 'booked'
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        /* FIXME: for loop */
        switch ($('#status').html()) {
            case 'booked':
                $('#status').css('color', '#A33431');
                break;

            case 'completed':
                $('#status').css('color', '#366B2C');
                break;

            default:
                $('#status').css('color', '#005aa4');
                break
        }
    </script>

@endsection
