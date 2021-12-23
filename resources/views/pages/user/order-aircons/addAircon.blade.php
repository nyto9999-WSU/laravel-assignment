@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>addAircon.blade</h1>

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <h1>Add aircon</h1>
                    <form action="{{ route('aircon.store', $order) }}" method="post">
                        @csrf
                        <label for="equipment_type">air-con type</label>
                        <input type="text" name="equipment_type">

                        <!--TODO: fill inputs based on Aircon cols-->
                        <button type="submit">aircon.store</button>
                    </form>

                    @forelse ($order->aircons as $aircon)
                        <table class="table">
                            <th>Model Number</th>
                            <th>Equipment Type</th>
                            <th>Issue</th>
                            <tr>
                                <td>
                                    <!--model number-->
                                </td>
                                <td>
                                    <!-- this quipment_type should be a dropdown-->
                                    {{ $aircon->equipment_type }}
                                </td>
                                <td>
                                    <!-- issue-->
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
