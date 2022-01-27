@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row g-2 mx-2">

        <div class="col-3">
            <h2>AirconDetails</h2>
                <small>The aircon details are shown in this page</small>
        </div>

        <div class="col-6">

        </div>

        


        <div class="col-12 shadow-sm rounded border border-2">

            <table class="table table-hover text-start mt-1">

                <thead class="text-white">
                    <tr id="red">
                        <th>ID</th>
                        <th>Model Number</th>
                        <th>Serial Number</th>
                        <th>Equipment Type</th>
                        <th>Domestic / Commercial</th>
                        <th>Install Address</th>
                        <th>Issue</th>
                        <th>Status</th>
                        

                    </tr>
                </thead>
                <tbody id="AirconDetails"> 
                    @forelse ($jobs as $job)           
                                <tr>
                                    

                                    {{-- job_id --}}
                                    <td>{{ $job->aircon_id }}</td>

                                    {{-- model_number/serial_number --}}
                                    <td>{{ $job->model_number }}</td>
                                    <td>{{ $job->serial_number }}</td>

                                    {{-- equipment_type --}}
                                    <td>{{ $job->equipment_type }}</td>

                                    
                                    {{-- domestic_commercial --}}
                                    <td>{{ $job->domestic_commercial }}</td>

                                    {{-- install_address --}}
                                    <td>{{ $job->install_address }}</td>



                                    {{-- issue --}}
                                    <td>{{ $job->issue }}</td>

                                    {{-- status --}}
                                    <td>{{ $job->status }}</td>

                                </tr>
                                @empty

                            @endforelse
                    
                </tbody>

            </table>

        </div>
        






            
    
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/pages/order/search-requested-jobs',
                data: {
                    's': $value,
                    status: 'booked'
                },
                success: function(data) {
                    // console.log(data);
                    $('#current_orders').html(data.html);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    </script>
@endsection

