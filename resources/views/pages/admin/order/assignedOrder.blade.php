@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <!-- <h1>Role: {{ Auth::user()->getRole() }}</h1> -->
        <!-- <h1>currentOrder.blade(admin)</h1> -->

        <div class="row g-2  mx-2">

            <div class="col-3">
                <h2>Assigned Jobs</h1>
                    <small>All assigned service requests are shown in this page</small>
            </div>

            <div class="col-6">

            </div>

            <div class="col-3 mt-3">
                <input type="text" class="form-control" id="search" placeholder="Search past request">
                <hr>
            </div>



            <div class="col-12 shadow-sm rounded border border-2">

                <table class="table table-hover text-start mt-1">

                    <thead class="text-white">
                        <tr id="blue">
                            <th>Complete</th>
                            <th>Job</th>
                            <th>Model/Serial</th>
                            <th>Unit Address</th>
                            <th>Requested Date</th>
                            <th>Assigned Date</th>
                            <th>Type</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Technician</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody id="current_orders">
                        @forelse ($orders as $order)
                            @forelse ($order->jobs as $job)
                                @if ($job->status == 'assigned')
                                    <tr>
                                        {{-- complete button --}}
                                        <td>
                                            <a href="{{ route('order.actions', [$order, 'job' => $job]) }}" id="blue"
                                                class="btn text-white">
                                                <i class="bi bi-check2"></i>
                                            </a>
                                        </td>

                                        {{-- job_id --}}
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

                                        {{-- install_address --}}
                                        <td>{{ $job->install_address }}</td>

                                        {{-- requested_date --}}
                                        <td>{{ date('d - M - Y h:iA', strtotime($order->created_at)) }}</td>

                                        {{-- assigned_date --}}
                                        <td>{{ date('d - M - Y h:iA', strtotime($job->assigned_at)) }}</td>

                                        {{-- domestic_commercial --}}
                                        <td>{{ $job->domestic_commercial }}</td>

                                        {{-- name --}}
                                        <td>{{ $order->name }}</td>

                                        {{-- mobile_number --}}
                                        <td>{{ $order->mobile_number }}</td>

                                        {{-- extra_note --}}
                                        <td>{{ $job->tech_name }}</td>

                                        {{-- TODO: Print --}}
                                        <td>
                                            <a href="{{ route('order.printOrder', $order->id) }}" id="blue"
                                                class="btn btn-primary">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif

                            @empty

                            @endforelse

                        @empty
                            <tr>
                                <td colspan="11" class=" text-center fw-bold">
                                    No Result
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
            <div class="d-flex flex-row-reverse">
                {!! $orders->links() !!}
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
                url: '/pages/order/search-requested-jobs',
                data: {
                    's': $value,
                    status: 'assigned'
                },
                success: function(data) {
                    // console.log(data);
                    $('#current_orders').html(data.html);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection
