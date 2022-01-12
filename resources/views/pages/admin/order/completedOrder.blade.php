@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<!-- Bootstrap core CSS -->
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">
<link href="{{asset('assets/CSS/bootstrap.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<!-- Custom styles for this template -->
<link href="{{asset('assets/CSS/form-validation.css')}}" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style media="screen">
  .navbar-nav{
    font-size:14px !important;
  }
  .container {
    max-width:1070px !important;
  }
  table {
    overflow:hidden;
  }
</style>




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
                    <tr>
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
                    </tr>
                  </thead>
                  <tbody id="current_orders">
                    @forelse ($orders as $order)
                  <tr>
                      {{-- assign button --}}
                      <td>
                          <a href="{{ route('order.actions' , $order) }}" id="color-blue" class="btn text-white">
                              <i class="bi bi-pen"></i>
                          </a>
                      </td>

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

                      {{-- created_at --}}
                      <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>

                      {{-- prefer_date --}}
                      <td>{{ date('d-m-Y', strtotime($order->prefer_date)) }}</td>

                      {{-- domestic_commercial --}}
                      <td>{{ $order->domestic_commercial }}</td>

                      {{-- extra_note --}}
                      <td>{{ $order->extra_note }}</td>
                  </tr>
              @empty
                  <h1>no data</h1>
              @endforelse
            </tbody>

                </table>

          </div>
          <nav aria-label="Page navigation example ">
            <ul class="pagination justify-content-end ">
              <li class="page-item disabled ">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
              </li>
              <li class="page-item"><a class="page-link " href="#">1</a></li>
              <li class="page-item"><a class="page-link " href="#">2</a></li>
              <li class="page-item"><a class="page-link " href="#">3</a></li>
              <li class="page-item">
                <a class="page-link  text-dark" href="#">Next</a>
              </li>
            </ul>
          </nav>

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
