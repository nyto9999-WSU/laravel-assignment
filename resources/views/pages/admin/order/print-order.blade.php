@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" id="my_table">
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
                          {{ $job->model_number }}
                        </td>
                    </tr>

                    <tr >
                        <td>Technician</td>
                        <td>
                            {{ $job->tech_name }}
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
                        <td>{{ $job->status }}</td>
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
                            {{ $job->install_address }}
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
                          {{ date('d-F-Y', strtotime($job->prefer_date)) }}
                        </td>
                    </tr>

                    {{-- prefer_time --}}
                    <tr>
                        <td>prefer_time</td>
                        <td>
                            {{ $job->prefer_time }}
                        </td>
                    </tr>

                    {{-- job_start_date --}}
                    <tr style="background:aliceblue;">
                        <td>Start Date</td>
                        <td>
                            {{ $job->start_date }}
                        </td>
                    </tr>

                    {{-- job_end_date --}}
                    <tr>
                        <td>End Date</td>
                        <td style="color:red;">
                            {{ $job->end_date }}
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
                            {{ $job->assigned_at }}
                        </td>

                    </tr>

                {{-- Aircon Issue --}}
                <tr style="background:aliceblue;">
                    <td>Aircon Issue</td>
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

                {{-- admin notes --}}
                <tr style="background:aliceblue;">
                    <td>Admin Note</td>
                    <td>
                        @forelse ($order->jobs as $job)
                            @forelse ($job->notes as $note)
                                <li>
                                    {{ $note->description }}
                                </li>
                            @empty
                            @endforelse
                        @empty

                        @endforelse
                    </td>
                </tr>
                </table>

                {{-- edit button --}}
            </div>
        </div>
        <input style="display:block; margin:0 auto;" type="button" class="btn btn-success" onclick="printDiv('my_table')" value="Click to Print"/>
    </div>
    </div>
    </div>

    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            w=window.open();
            w.document.write(printContents);
            w.print();
            w.close();
        }
    </script>
@endsection
