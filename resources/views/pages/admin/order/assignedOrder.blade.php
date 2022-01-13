@extends('layouts.app')

@section('content')

    <div class="container-fluid mt-3">
        <!-- <h1>Role: {{ Auth::user()->getRole() }}</h1> -->
        <!-- <h1>currentOrder.blade(admin)</h1> -->

        <div class="row g-2  mx-2">

            <div class="col-3">
                <h2>Assigned Jobs</h1>
                    <small>All assigned service requests are shown in this page</small>
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
                        <tr id="blue">
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
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody id="current_orders">
                        @forelse ($orders as $order)
                            <tr>

                                {{-- complete button --}}
                                <td>
                                    <a href="{{ route('order.actions', $order) }}" id="blue" class="btn text-white">
                                      <i class="bi bi-check2"></i>
                                    </a>
                                </td>

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
                                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>

                                {{-- prefer_date --}}
                                <td>{{ date('d-m-Y', strtotime($order->prefer_date)) }}</td>

                                {{-- domestic_commercial --}}
                                <td>{{ $order->domestic_commercial }}</td>

                                {{-- extra_note --}}
                                <td>{{ $order->extra_note }}</td>

                                {{-- TODO: Print --}}
                                <td>
                                    <a href="{{ route('order.printOrder', $order->id) }}" id="blue" class="btn btn-primary">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>


                            </tr>
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
