@forelse ($orders as $order)
    @forelse ($order->jobs as $job)
        @if ($job->status == 'assigned')
            <tr>
                {{-- complete button --}}
                <td>
                    <a href="{{ route('order.actions', [$order, 'job' => $job]) }}" id="blue"
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
                        <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                            Model: {{ $job->model_number }}
                        </a>
                    </li>
                    <li>
                        <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                            Serial: {{ $job->serial_number }}
                        </a>
                    </li>
                </td>

                {{-- install_address --}}
                <td>{{ $job->install_address }}</td>

                {{-- requested_date --}}
                <td>{{ date('d - M - Y h:iA', strtotime($order->created_at)) }}</td>

                {{-- assigned_date --}}
                <td>{{ date('d - M - Y h:iA', strtotime($job->assigned_at)) }}</td>

                {{-- domestic_commercial --}}
                <td>{{ $job->domestic_commercial }}</td>

                {{-- name --}}
                <td>{{ $order->name }}</td>

                {{-- mobile_number --}}
                <td>{{ $order->mobile_number }}</td>

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
    <tr>
        <td colspan="11" class=" text-center fw-bold">
            No Result
        </td>
    </tr>
@endforelse
