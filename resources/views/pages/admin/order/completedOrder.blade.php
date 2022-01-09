@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>completedOrder.blade(admin)</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-4">Search</div>
                <div class="col-6">
                    <input type="text" id="search" class="form-control">
                </div>
                <div id="current_orders">
                <table class="table" >
                    @forelse ($orders as $order)
                        <tr>
                            <th>Order</th>
                            <th>Model</th>
                            <th>No. of unit</th>
                            <th>Customer</th>
                            <th>Unit Address</th>
                            <th>Phone</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Service Type</th>
                            <th>Technician</th>
                        </tr>
                        <tr>
                            {{-- action button --}}
                            {{-- <td>
                                <a href="{{ route('order.actions' , $order) }}" class="btn btn-primary">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td> --}}

                            {{-- order_id --}}
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

                            {{-- job_start_date --}}
                            <td>{{ date('d-m-Y', strtotime($order->job_start_date)) }}</td>

                            {{-- job_end_date --}}
                            <td>{{ date('d-m-Y', strtotime($order->job_end_date)) }}</td>


                            {{-- prefer_date --}}
                            <td>{{ $order->domestic_commercial }}</td>

                            {{-- FIXME: technician --}}
                            <td>{{ optional($order->job)->user_id }}</td>
                        </tr>
                    @empty
                        <h1>no data</h1>
                    @endforelse
                </table>
            </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
    $('#search').on('keyup',function(){
    $value=$(this).val();
    $.ajax({
    type : 'get',
    url : '/pages/order/search-requested-jobs',
    data:{'s':$value, status:'completed'},
    success:function(data){
        // console.log(data);
    $('#current_orders').html(data.html);
    }
    });
    })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>


@endsection



{{-- completed orders --}}
{{-- completed orders --}}
