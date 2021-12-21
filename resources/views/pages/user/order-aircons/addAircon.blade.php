@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Add aircon</h1>
                    <form action="{{ route('aircon.store', $order) }}" method="post">
                        @csrf
                            <label for="type">air-con type</label>
                            <input type="text" name="type">
                            <button type="submit">submit</button>
                    </form>

                    TODO: #7 Fill all data based on below "<th>"
                    @forelse ($order->aircons as $aircon)
                        <table>
                            <th>Model Number</th>
                            <th>Equipment Type</th>
                            <th>Issue</th>

                            <tr>
                                <td>
                                    //TODO:Model number
                                </td>
                                <td>
                                    {{ $aircon->type }}
                                </td>
                                <td>
                                    //TODO:Issue
                                </td>
                            </tr>
                        </table>
                    @empty
                        <h1>no data</h1>
                    @endforelse

                    <button type="submit">Send Email confirmation</button>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
