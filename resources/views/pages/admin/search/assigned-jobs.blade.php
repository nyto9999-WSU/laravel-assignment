@forelse ($orders as $order)
    @forelse ($order->jobs as $job)
        @if ($job->status == 'assigned')
            <tr>
                {{-- complete button --}}
                <td>
                    <button type="button" id="blue" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="bi bi-check2"></i>
                    </button>
                </td>

                <!-- Modal -->
                <div class="modal" id="exampleModal" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Job ID: {{ $job->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    Are you sure?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                    <a href="{{ route('order.actions', [$order, 'job' => $job]) }}" id="blue"
                                        class="btn text-white">
                                        Complete!
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- job_id --}}
                <td>
                    <a href="{{ route('job.show', $job) }}">{{ $job->id }}</a>
                </td>

                {{-- model_number --}}
                <td>
                    <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                        {{ $job->model_number }}
                    </a>
                </td>
                {{-- serail_number --}}
                <td>
                    <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                        {{ $job->serial_number }}
                    </a>
                </td>

                {{-- name --}}
                <td>{{ $order->name }}</td>

                {{-- install_address --}}
                <td>{{ $job->install_address }}</td>

                {{-- mobile_number --}}
                <td>{{ $order->mobile_number }}</td>

                {{-- created_at --}}
                <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>

                {{-- assigned_at --}}
                <td>{{ date('d-m-Y', strtotime($job->assigned_at)) }}</td>

                {{-- domestic_commercial --}}
                <td>{{ $job->domestic_commercial }}</td>

                {{-- extra_note --}}
                <td>{{ $job->tech_name }}</td>

                {{-- TODO: Print --}}
                <td>
                    <a href="{{ route('order.printOrder', $order->id) }}" id="blue"
                        class="btn btn-primary">
                        <i class="bi bi-printer"></i>
                    </a>
                </td>
            </tr>
        @endif

    @empty

    @endforelse

@empty
    <h1>no data</h1>
@endforelse
