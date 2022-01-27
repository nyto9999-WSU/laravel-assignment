@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row g-2 mx-2">

            <div class="col-3">
                <h2>Requested Jobs</h2>
                <small>All new service requests are shown in this page</small>
            </div>

            <div class="col-6">

            </div>

            <div class="col-3 mt-3">
                {{-- Search bar --}}
                <form type="get" action="/job/current-job-search">
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
                        <tr id="red">
                            <th>Assign</th>
                            <th>Job</th>
                            <th>Model/Serial</th>
                            <th>Unit Address</th>
                            <th>Preferred Date</th>
                            <th>Preferred Time</th>
                            <th>Type</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Requested Date</th>
                        </tr>
                    </thead>
                    <tbody id="current_orders">
                        @forelse ($jobs as $job)
                            @if ($job->status == 'booked')
                                <tr>
                                    {{-- assign button --}}
                                    <td>
                                        <a href="{{ route('order.actions', [$job->order, $job]) }}" id="red"
                                            class="btn text-white">
                                            <i id="id=" blue"" class="bi bi-pen"></i>
                                        </a>
                                    </td>

                                    {{-- job_id --}}
                                    <td>
                                        <a href="{{ route('job.show', $job) }}">{{ $job->id }}</a>
                                    </td>

                                    {{-- model_number/serial_number --}}
                                    <td>
                                        <li>
                                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $job]) }}>
                                                Model: {{ $job->model_number }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $job]) }}>
                                                Serial: {{ $job->serial_number }}
                                            </a>
                                        </li>
                                    </td>

                                    {{-- install_address --}}
                                    <td>{{ $job->install_address }}</td>

                                    {{-- prefer_date --}}
                                    <td class="fw-bold text-danger">
                                        {{ date('d - M - Y', strtotime($job->prefer_date)) }}</td>

                                    {{-- prefer_time --}}
                                    <td class="fw-bold text-danger">{{ $job->prefer_time }}</td>

                                    {{-- domestic_commercial --}}
                                    <td>{{ $job->domestic_commercial }}</td>

                                    {{-- name --}}
                                    <td>{{ $job->order->name }}</td>

                                    {{-- mobile_number --}}
                                    <td>{{ $job->order->mobile_number }}</td>

                                    {{-- created_at --}}
                                    <td>{{ date('d - M - Y h:iA', strtotime($job->order->created_at)) }}</td>

                                </tr>
                            @endif

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
            <div class="d-flex flex-row-reverse">
                {!! $jobs->links() !!}
            </div>
        </div>

    </div>

@endsection
