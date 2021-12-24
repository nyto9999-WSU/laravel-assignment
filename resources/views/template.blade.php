<form action="{{ route('aircon.store', $order) }}" method="post">
    @csrf

    {{--inputs... --}}

    <button type="submit">aircon.store</button>
</form>

@forelse ($order->aircons as $aircon)
    <table class="table">
        <th>Model Number</th>
            {{-- th.. --}}
        <tr>
            {{-- td... --}}
            <td>
                {{-- Delete Aircon --}}
                <form action="{{ route('aircon.destroy', $aircon) }}" method="post">
                    @method('DELETE')
                    @csrf
                    {{-- button submit --}}
                </form>
            </td>
        </tr>
    </table>
@empty
    <h1>no data</h1>
@endforelse