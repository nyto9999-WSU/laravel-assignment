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
                    <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                        {{ $job->model_number }}
                    </a>
                </td>
                {{-- serial_number --}}
                <td>
                    <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                        {{ $job->serial_number }}
                    </a>
                </td>

                {{-- name --}}
                <td>{{ $order->name }}</td>

                {{-- install_address --}}
                <td>{{ $order->address }}</td>

                {{-- mobile_number --}}
                <td>{{ $order->mobile_number }}</td>

                {{-- created_at --}}
                <td>{{ date('d-m-Y', strtotime($job->assigned_at)) }}</td>

                {{-- prefer_date --}}
                <td>{{ date('d-m-Y', strtotime($job->end_date)) }}</td>

                {{-- domestic_commercial --}}
                <td>{{ $job->domestic_commercial }}</td>
            </tr>
        @endif

    @empty

    @endforelse

@empty
    <h1>no data</h1>
@endforelse
