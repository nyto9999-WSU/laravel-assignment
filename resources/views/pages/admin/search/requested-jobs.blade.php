@forelse ($orders as $order)
    @forelse ($order->jobs as $job)
    @if ($job->status == 'booked')
    <tr>
        {{-- assign button --}}
        <td>
            <a href="{{ route('order.actions', [$order, 'job' => $job]) }}" id="red" class="btn text-white">
                <i id="id=" blue"" class="bi bi-pen"></i>
            </a>
        </td>

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
        {{-- serial_number --}}
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

        {{-- prefer_date --}}
        <td>{{ date('d-m-Y', strtotime($job->prefer_date)) }}</td>

        {{-- domestic_commercial --}}
        <td>{{ $job->domestic_commercial }}</td>

        {{-- extra_note --}}
        <td>{{ $order->extra_note }}</td>
    </tr>
    @endif

    @empty

    @endforelse
@empty
    <h1>no data</h1>
@endforelse
