@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row g-2">

            <h2 class="text-center">Service Request History</h1>
                {{-- Search bar --}}
                <form type="get" action="/job/customer-job-search">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control mr-2" name="query" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2" value="">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
                <table class="table table-hover">
                    <thead class="text-black text-wrap">
                        <tr>
                            <th>Job ID</th>
                            <th style="">Model/Serial</th>
                            <th style="">Requested Date</th>
                            <th style="">Assigned Date</th>
                            <th style="">Completed Date</th>
                            <th>Technician</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $job)
                            @if (Auth::user()->id == $job->order->user_id)

                            <tr>
                                {{-- job-id --}}
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

                                {{-- Requested date --}}
                                <td class="text-danger fw-bold">
                                    {{ date('d-M-Y', strtotime($job->order->created_at)) }}
                                </td>

                                {{-- job_start_date --}}
                                @if (!empty($job->start_date))
                                    <td class="text-primary fw-bold">
                                        {{ date('d-M-Y', strtotime($job->start_date)) }}
                                    </td>
                                @else
                                    <td>
                                        N/A
                                    </td>
                                @endif

                                {{-- job_end_date --}}
                                @if (!empty($job->end_date))
                                    <td class="text-success fw-bold">
                                        {{ date('d-M-Y', strtotime($job->end_date)) }}
                                    </td>
                                @else
                                    <td>
                                        N/A
                                    </td>
                                @endif

                                <td>
                                    @if (!empty($job->tech_name))
                                        {{ $job->tech_name }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="text-capitalize" id="status">{{ $job->status }}</td>

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



@endsection
