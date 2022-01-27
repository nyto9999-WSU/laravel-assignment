@extends('layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="row g-2  mx-2">

            <div class="col-3">
                <h2>Completed Jobs</h1>
                    <small>All completed requests are shown in this page</small>
            </div>

            <div class="col-6">

            </div>

            <div class="col-3 mt-3">
                {{-- Search bar --}}
                <form type="get" action="/job/completed-job-search">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control mr-2" name="query" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2" value="">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
                <hr>
            </div>

            <div class="col-12 shadow-sm rounded border border-2">

                <table class="table table-hover text-start mt-1">

                    <thead class="text-white">
                        <tr id="green">

                            <th>Job</th>
                            <th>Model&Serial</th>
                            <th>Unit Address</th>
                            <th>Assigned Date</th>
                            <th>Completed Date</th>
                            <th>Service Type</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Technician</th>
                        </tr>
                    </thead>
                    <tbody id="current_orders">
                        @forelse ($jobs as $job)
                            @if ($job->status == 'completed')
                                <tr>
                                    {{-- job->id --}}
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
                                    <td>{{ $job->order->address }}</td>

                                    {{-- assigned_at --}}
                                    <td class="">
                                        {{ date('d - M - Y h:iA', strtotime($job->assigned_at)) }}</td>

                                    {{-- end_date --}}
                                    <td class="text-success fw-bold">
                                        {{ date('d - M - Y h:iA', strtotime($job->end_date)) }}</td>

                                    {{-- domestic_commercial --}}
                                    <td>{{ $job->domestic_commercial }}</td>

                                    {{-- name --}}
                                    <td>{{ $job->order->name }}</td>

                                    {{-- mobile_number --}}
                                    <td>{{ $job->order->mobile_number }}</td>

                                    {{-- technician name --}}
                                    <td>{{ $job->tech_name }}</td>
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



{{-- completed orders --}}
{{-- completed orders --}}
