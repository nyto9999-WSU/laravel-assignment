@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Role: {{ Auth::user()->getRole() }}</h1>
            <h1>showAirconDetails.blade</h1>
            <div class="col-md-8">
                <table>
                    {{-- aircon_id --}}
                    <tr>
                        <th>ID</th>
                        <td>{{ $aircon->id }}</td>
                    </tr>

                    {{-- model_number --}}
                    <tr>
                        <th>Model Number</th>
                        <td>{{ $aircon->model_number }}</td>
                    </tr>

                    {{-- equipment_type --}}
                    <tr>
                        <th>Equipment Type</th>
                        <td>{{ $aircon->equipment_type }}</td>
                    </tr>

                    {{-- issue --}}
                    <tr>
                        <th>Issue</th>
                        <td>{{ $aircon->issue }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
