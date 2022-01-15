@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">
        <!-- <h1>Role: {{ Auth::user()->getRole() }}</h1> -->
        <!-- <h1>currentOrder.blade(admin)</h1> -->

        <div class="row g-2  mx-2">

            <div class="col-3">
                <h2>Completed Jobs</h1>
                    <small>All completed requests are shown in this page</small>
            </div>

            <div class="col-6">

            </div>

            <div class="col-3">
                <input type="text" class="form-control" id="search" placeholder="Search past request">
                <hr>
            </div>

            <div class="col-12 shadow-sm rounded border border-2">

                <table class="table table-hover text-start mt-1">

                    <thead class="text-white">
                        <tr id="green">

                            <th>Job</th>
                            <th>Model</th>
                            <th>Serial</th>
                            <th>Customer</th>
                            <th>Unit Address</th>
                            <th>Phone</th>
                            <th>Assigned Date</th>
                            <th>Completed Date</th>
                            <th>Service Type</th>
                        </tr>
                    </thead>
                    <tbody id="current_orders">
                        @forelse ($orders as $order)
                            @forelse ($order->jobs as $job)
                                @if ($job->status == 'completed')
                                    <tr>

                                        {{-- order_id --}}
                                        <td>
                                            <a href="{{ route('job.show', $job) }}">{{ $job->id }}</a>
                                        </td>

                                        {{-- model_number --}}
                                        <td>
                                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                                {{ $job->model_number }}
                                            </a>
                                        </td>
                                        {{-- serial_number --}}
                                        <td>
                                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                                {{ $job->serial_number }}
                                            </a>
                                        </td>

                                        {{-- name --}}
                                        <td>{{ $order->name }}</td>

                                        {{-- install_address --}}
                                        <td>{{ $order->address }}</td>

                                        {{-- mobile_number --}}
                                        <td>{{ $order->mobile_number }}</td>

                                        {{-- created_at --}}
                                        <td>{{ date('d-m-Y', strtotime($job->assigned_at)) }}</td>

                                        {{-- prefer_date --}}
                                        <td>{{ date('d-m-Y', strtotime($job->end_date)) }}</td>

                                        {{-- domestic_commercial --}}
                                        <td>{{ $job->domestic_commercial }}</td>
                                    </tr>
                                @endif

                            @empty

                            @endforelse

                        @empty
                            <h1>no data</h1>
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
                    status: 'completed'
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



{{-- completed orders --}}
{{-- completed orders --}}
