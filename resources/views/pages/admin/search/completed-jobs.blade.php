@forelse ($orders as $order)
    @forelse ($order->jobs as $job)
        @if ($job->status == 'completed')
            <tr>

                {{-- order_id --}}
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
                <td>{{ $order->address }}</td>

                {{-- assigned_at --}}
                <td class="">
                    {{ date('d - M - Y h:iA', strtotime($job->assigned_at)) }}</td>

                {{-- end_date --}}
                <td class="text-success fw-bold">
                    {{ date('d - M - Y h:iA', strtotime($job->end_date)) }}</td>

                {{-- domestic_commercial --}}
                <td>{{ $job->domestic_commercial }}</td>

                {{-- name --}}
                <td>{{ $order->name }}</td>

                {{-- mobile_number --}}
                <td>{{ $order->mobile_number }}</td>

                {{-- technician name --}}
                <td>{{ $job->tech_name }}</td>
            </tr>
        @endif

    @empty

    @endforelse

@empty
    <tr>
        <td colspan="10" class=" text-center fw-bold">
            No Result
        </td>
    </tr>
@endforelse
