@extends('layouts.app')

@section('content')

    <div class="container-fluid" id="current_orders">


            <div class="row g-2  mx-2">

                <div class="col-3">
                    <h2>Assigned Jobs</h1>
                        <small>All assigned service requests are shown in this page</small>

                </div>

                <div class="col-3">

                </div>
                <div class="col-3">
                    <form class="" action="{{ route('order.print-all-order') }}" method="post" target="_blank">
                        @csrf
                    <div class="input-group mt-2">

                        <select class="form-select" name="start_date" id="start_date" onchange="mySearch()">
                            <option value="">All</option>
                            @if (!empty($start_date))
                                @foreach ($start_date as $s)
                                    <option value="{{ $s }}">{{ date('d - M - Y', strtotime($s)) }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Print</button>
                        </div>
                    </div>
                    </form>
                </div>


                <div class="col-3 mt-3">
                    {{-- Search bar --}}
                    <form type="get" action="/job/assigned-job-search">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control mr-2" name="query" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="button-addon2"
                                value="">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                        </div>
                    </form>
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
                                <th>Start Date</th>
                                <th>Type</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Technician</th>
                                <th>Print</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobs as $job)
                                @if ($job->status == 'assigned')

                                <tr>
                                    {{-- complete button --}}
                                    <td>
                                        <input type="hidden" name="job_id[]" value="{{ $job->order->id }}">
                                        <a href="{{ route('order.actions', [$job->order, 'job' => $job]) }}" id="blue"
                                            onclick="return confirm('Are you sure ? You want to mark this as completed?')"
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
                                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $job->order]) }}>
                                                Model: {{ $job->model_number }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $job->order]) }}>
                                                Serial: {{ $job->serial_number }}
                                            </a>
                                        </li>
                                    </td>

                                    {{-- install_address --}}
                                    <td>{{ $job->install_address }}</td>

                                    {{-- requested_date --}}
                                    <td>{{ date('d - M - Y h:iA', strtotime($job->order->created_at)) }}</td>

                                    {{-- assigned_date --}}
                                    <td>{{ date('d - M - Y h:iA', strtotime($job->assigned_at)) }}</td>

                                    {{-- start date --}}
                                    <td>{{ date('d - M - Y', strtotime($job->start_date)) }}</td>

                                    {{-- domestic_commercial --}}
                                    <td>{{ $job->domestic_commercial }}</td>

                                    {{-- name --}}
                                    <td>{{ $job->order->name }}</td>

                                    {{-- mobile_number --}}
                                    <td>{{ $job->order->mobile_number }}</td>

                                    {{-- extra_note --}}
                                    <td>{{ $job->tech_name }}</td>

                                    {{-- TODO: Print --}}
                                    <td>
                                        <a href="{{ route('order.printOrder', [$job->order, $job]) }}" id="blue"
                                            class="btn btn-primary">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="12" class=" text-center fw-bold">
                                        No Result
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>
                <div class="d-flex flex-row-reverse">
                    {!! $jobs->links() !!}
                </div>

            </div>
        </form>
    </div>
@endsection
