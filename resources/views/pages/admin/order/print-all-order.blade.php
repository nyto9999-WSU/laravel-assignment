@extends('layouts.app')

@section('content')
        <input style="display:block; margin:0 auto;" type="button" class="btn btn-success" onclick="printDiv('my_table')" value="Click to Print"/>
    <div class="container" id="my_table">
      @foreach($order_p as $order)
        <div class="row justify-content-center" style="min-height:1050px;">
            <div class="col-md-8" >
                <img src='http://pioneerair.com.au/img/pioneer/pioneer-logo.png' alt="" width="250">
                <h3>Job Worksheet</h3>
                <table class="table" border="1" style="border-collapse:collapse;" width="90%" cellpadding="3" cellspacing="3">
                  <tr bgcolor="lightblue">
                      <th>Title</th>
                      <th>Description</th>
                  </tr>
                    {{-- order_id --}}
                    <tr>
                        <td>Order</td>
                        <td>{{ $order->id }}</td>
                    </tr>
                    {{-- model_number --}}
                    <tr style="background:aliceblue;">
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

                    <tr >
                        <td>Technician</td>
                        <td>

                          @forelse ($order->jobs as $job)
                          @if (!empty($job->tech_name))
                              {{ $job->tech_name }}
                              <br/>
                          @else
                              N/A
                          @endif
                          @empty

                          @endforelse
                        </td>
                    </tr>

                    {{-- extra_note --}}
                    <tr style="background:aliceblue;">
                        <td>Description</td>
                        <td>{{ $order->extra_note }}</td>
                    </tr>

                    {{-- status --}}
                    <tr>
                        <td>Status</td>
                        <td style="text-transform:capitalize;">
                          @forelse ($order->jobs as $job)
                          @if (!empty($job->status))
                              {{ $job->status }}
                              <br/>
                          @else
                              N/A
                          @endif
                          @empty

                          @endforelse
                        </td>
                    </tr>

                    {{-- name --}}
                    <tr style="background:aliceblue;">
                        <td>Owner</td>
                        <td>{{ $order->name }}</td>
                    </tr>

                    {{-- email --}}
                    <tr>
                        <td>Email Address</td>
                        <td>{{ $order->email }}</td>
                    </tr>

                    {{-- install_address --}}
                    <tr style="background:aliceblue;">
                        <td>Installation Address</td>
                        <td>
                          @forelse ($order->jobs as $job)
                          @if (!empty($job->install_address))
                              {{ $job->install_address }}
                              <br/>
                          @else
                              N/A
                          @endif
                          @empty

                          @endforelse
                        </td>
                    </tr>

                    {{-- state --}}
                    <tr>
                        <td>State</td>
                        <td>{{ $order->state }}</td>
                    </tr>

                    {{-- suburb --}}
                    <tr style="background:aliceblue;">
                        <td>Suburb</td>
                        <td>{{ $order->suburb }}</td>
                    </tr>

                    {{-- postcode --}}
                    <tr>
                        <td>Postcode</td>
                        <td>{{ $order->postcode }}</td>
                    </tr>

                    {{-- prefer_date --}}
                    <tr style="background:aliceblue;">
                        <td>Prefer Date</td>
                        <td>
                          @forelse ($order->jobs as $job)
                          @if (!empty($job->prefer_date))
                              {{ date('d-F-Y', strtotime($job->prefer_date)) }}
                              <br/>
                          @else
                              N/A
                          @endif
                          @empty

                          @endforelse
                        </td>
                    </tr>

                    {{-- prefer_time --}}
                    <tr>
                        <td>prefer_time</td>
                        <td>
                          @forelse ($order->jobs as $job)
                          @if (!empty($job->prefer_time))
                              {{ $job->prefer_time }}
                              <br/>
                          @else
                              N/A
                          @endif
                          @empty

                          @endforelse
                        </td>
                    </tr>

                    {{-- job_start_date --}}
                    <tr style="background:aliceblue;">
                        <td>Start Date</td>
                        <td>
                          @forelse ($order->jobs as $job)
                          @if (!empty($job->start_date))
                              {{ date('d-F-Y', strtotime($job->start_date)) }}
                              <br/>
                          @else
                              N/A
                          @endif
                          @empty
                          @endforelse
                        </td>
                    </tr>

                    {{-- job_end_date --}}
                    <tr>
                        <td>End Date</td>
                        <td style="color:red;">
                          @forelse ($order->jobs as $job)
                          @if (!empty($job->end_date))
                              {{ date('d-F-Y', strtotime($job->end_date)) }}
                              <br/>
                          @else
                              N/A
                          @endif
                          @empty
                          @endforelse
                        </td>
                    </tr>

                    {{-- created_at --}}
                    <tr style="background:aliceblue;">
                        <td>Requested Date</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>

                    {{-- assigned_at --}}
                    <tr>
                        <td>Assigned at</td>
                        <td>
                            @if (!empty($order->assigned_at))
                                {{ $order->assigned_at }}
                            @else
                                N/A
                            @endif
                        </td>

                    </tr>

                {{-- Note --}}
                <tr style="background:aliceblue;">
                    <td>Note</td>
                    <td>
                      @forelse ($order->jobs as $job)
                      @if (!empty($job->issue))
                          {{ $job->issue }}
                          <br/>
                      @else
                          N/A
                      @endif
                      @empty
                      @endforelse
                    </td>

                </tr>
                </table>

                {{-- edit button --}}
            </div>
        </div>
        @endforeach
      </div>


    <script type="text/javascript">
        function printDiv(divName)
        {
            var printContents = document.getElementById(divName).innerHTML;
            w=window.open();
            w.document.write(printContents);
            w.print();
            w.close();
        }
    </script>
@endsection
