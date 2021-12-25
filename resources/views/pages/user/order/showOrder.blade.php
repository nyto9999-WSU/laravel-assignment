@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Role: {{ Auth::user()->getRole() }}</h1>
                <h1>showOrder.blade</h1>
                <table class="table">
                    <tr>
                        <th>Order</th>
                        <th>Owner</th>
                        <th>Description</th>
                        <th>Air-con Type</th>
                    </tr>
                    <tr>
                        <td>{{ $order->id }}</td>

                        <td>{{ $order->user->name }}</td>

                        <td>{{ $order->desc }}</td>

                        <td>
                            @forelse ($order->aircons as $aircon)
                                <li>
                                    {{ $aircon->type }} <br>
                                </li>
                            @empty

                            @endforelse
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
