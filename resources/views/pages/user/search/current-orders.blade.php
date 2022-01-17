@forelse ($orders as $order)
    @forelse ($order->jobs as $job)
        <tr>

            {{-- job-id --}}
            <td>
                <a href="{{ route('job.show', $job) }}">{{ $job->id }}</a>
            </td>
            {{-- model_number --}}
            <td>
                <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                    {{ $job->model_number }}
                </a>
                <a href="{{ route('aircon.showAll', [$order]) }}" class="position-relative">
                    all
                </a>
            </td>
            {{-- serial_number --}}
            <td>
                <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                    {{ $job->serial_number }}
                </a>
                <a href="{{ route('aircon.showAll', [$order]) }}" class="position-relative">
                    all
                </a>
            </td>

            {{-- Requested date --}}
            <td>{{ date('d-m-Y', strtotime($job->prefer_date)) }}</td>

            {{-- job_start_date --}}
            <td>
                @if (!empty($job->start_date))
                    {{ $job->start_date }}
                @else
                    N/A
                @endif
            </td>

            {{-- job_end_date --}}
            <td>
                @if (!empty($job->end_date))
                    {{ $job->end_date }}
                @else
                    N/A
                @endif
            </td>

            <td>
                @if (!empty($job->tech_name))
                    {{ $job->tech_name }}
                @else
                    N/A
                @endif
            </td>

            {{-- Status --}}
            <td class="text-capitalize">{{ $job->status }}</td>

        </tr>
    @empty

    @endforelse

@empty
    <h1>No Data</h1>
@endforelse
