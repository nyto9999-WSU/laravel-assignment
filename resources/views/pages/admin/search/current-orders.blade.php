@forelse ($orders as $order)
    @forelse ($order->jobs as $job)
    <tr>
        {{-- assign button --}}
        <td>
            <a href="{{ route('order.actions', $order) }}" id="blue" class="btn btn-primary">
                <i class="bi bi-pen"></i>
            </a>
        </td>

        {{-- order_id --}}
        <td>
            <a href={{ route('order.show', $order->id) }}>{{ $order->id }}</a>
        </td>

        {{-- model_number --}}
        <td>
            @forelse ($order->aircons as $aircon)
                <li>
                    <a href={{ route('aircon.show', [$aircon, $order]) }}>
                        {{ $aircon->model_number }}
                    </a>
                </li>
            @empty
                N/A
            @endforelse

            <li>All</li>
        </td>
        {{-- serial_number --}}
        <td>
            @forelse ($order->aircons as $aircon)
                <li>
                    <a href={{ route('aircon.show', [$aircon, $order]) }}>
                        {{ $aircon->serial_number }}
                    </a>
                </li>
            @empty
                N/A
            @endforelse

            <li>All</li>
        </td>

        {{-- no_of_unit --}}
        <td>{{ $order->no_of_unit }}</td>

        {{-- name --}}
        <td>{{ $order->name }}</td>

        {{-- install_address --}}
        <td>{{ $order->install_address }}</td>

        {{-- mobile_number --}}
        <td>{{ $order->mobile_number }}</td>

        {{-- created_at --}}
        <td>{{ $order->created_at }}</td>

        {{-- prefer_date --}}
        <td>{{ $order->prefer_date }}</td>

        {{-- domestic_commercial --}}
        <td>{{ $order->domestic_commercial }}</td>

        {{-- extra_note --}}
        <td>{{ $order->extra_note }}</td>
        @if ($status == 'assigned')
            {{-- TODO: Print --}}
            <td>
                <a href="{{ route('order.printOrder', $order->id) }}" class="btn btn-primary">
                    <i class="bi bi-printer"></i>
                </a>
            </td>
        @endif
    </tr>
@empty
@endforelse
 @empty
    <h1>no data</h1>
@endforelse
