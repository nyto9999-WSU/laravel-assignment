@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>currentOrder.blade</h1>
        <div class="row g-2">

            <h2 class="text-center">Service Request History</h1>
            <input type="text" class="form-control" placeholder="Search request">
  
            <table class="table table-hover">
                <thead class="text-black text-wrap">
                <tr>

                    <th>Job ID</th>
                    <th style="">Model</th>
                    <th style="">Requested Date</th>
                    <th style="">Assigned Date</th>
                    <th style="">Completed Date</th>

                    <th>Technician</th>
                    <th>Status</th>
                    
                </tr>
                </thead>
                @forelse ($orders as $order)
                    <tr>

                            <td>
                                <a href="{{ route('order.show', $order) }}">{{ $order->id }}</a>
                            </td>
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
                                {{-- TODO:show all aircon details --}}
                            <li>
                                <a href={{ route('aircon.showAll', [$order]) }}>
                                    all
                                </a>
                            </li>
                        </td>
                        <td>
                            <span class="position-relative">
                                all models info
                                <span
                                    class="ms-3 position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $order->aircons->count() }}
                                </span>
                            </span>
                        </td>


                        {{-- Requested date --}}
                        <td>{{ $order->prefer_date }}</td>

                        {{-- job_start_date --}}
                        <td>
                            @if (!empty($order->job_start_date))
                                {{ $order->job_start_date }}
                            @else
                                N/A
                            @endif
                        </td>

                        {{-- job_end_date --}}
                        <td>
                            @if (!empty($order->job_end_date))
                                {{ $order->job_end_date }}
                            @else
                                N/A
                            @endif
                        </td>

                        {{-- Technician FIXME: #30: --}}
                        <td>
                            @if (!empty($order->job->user_id))
                                {{ $order->job->user_id }}
                            @else
                                N/A
                            @endif
                        </td>

                        {{-- Status --}}
                        <td>{{ $order->status }}</td>

                        {{-- delete button --}}

                        <td>
                            <form action="{{ route('order.destroy', $order) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <h1>No Data</h1>
                @endforelse
            </table>

        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
