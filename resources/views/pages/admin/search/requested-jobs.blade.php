@forelse ($orders as $order)
    @forelse ($order->jobs as $job)
        @if ($job->status == 'booked')
            <tr>
                {{-- assign button --}}
                <td>
                    <a href="{{ route('order.actions', [$order, 'job' => $job]) }}" id="red"
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

                {{-- prefer_date --}}
                <td class="fw-bold text-danger">
                    {{ date('d - M - Y', strtotime($job->prefer_date)) }}</td>

                {{-- prefer_time --}}
                <td class="fw-bold text-danger">{{ $job->prefer_time }}</td>

                {{-- domestic_commercial --}}
                <td>{{ $job->domestic_commercial }}</td>

                {{-- name --}}
                <td>{{ $order->name }}</td>



                {{-- mobile_number --}}
                <td>{{ $order->mobile_number }}</td>

                {{-- created_at --}}
                <td>{{ date('d - M - Y h:iA', strtotime($order->created_at)) }}</td>

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
