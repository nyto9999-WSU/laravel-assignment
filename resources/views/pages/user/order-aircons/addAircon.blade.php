@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>addAircon.blade</h1>

                <h1>Add aircon</h1>
                <form action="{{ route('aircon.store', $order) }}" method="post">
                    @csrf

                    {{-- model_number --}}
                    <label for="model_number">Model Number</label>
                    <input type="text" name="model_number">

                    {{-- equipment_type --}}
                    <select class="" name="equipment_type">
                        <option disabled selected value>Equipment Type</option>
                        <option value="ducted system">Ducted System</option>
                        <option value="package unit">package unit</option>
                        <option value="watercool unit">watercool</option>
                        <option value="mini VRF">mini VRF</option>
                        <option value="spilt system">spilt system</option>
                    </select>

                    {{-- other_type --}}
                    <label for="other_type">Other Type</label>
                    <input type="text" name="other_type">

                    {{-- issue --}}
                    <label for="issue">Issue</label>
                    <input type="text" name="issue">

                    <button type="submit">aircon.store</button>
                </form>

                @forelse ($order->aircons as $aircon)
                    <table class="table">
                        <th>Model Number</th>
                        <th>Equipment Type</th>
                        <th>Issue</th>
                        <th>Cancel</th>
                        <tr>
                            <td>{{ $aircon->model_number }}</td>
                            <td>{{ $aircon->equipment_type }}</td>
                            <td>{{ $aircon->issue }}</td>
                            <td>
                                <form action="{{ route('aircon.destroy', [$aircon, $order]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </table>
                @empty
                    <h1>no data</h1>
                @endforelse
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
