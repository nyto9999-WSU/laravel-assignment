@extends('layouts.app')

@section('content')
    <div class="container-fluid">
                <div class="row mt-3">

                    {{-- Registered User --}}
                    <div class="col-md-2 pe-2">
                        <div class="card">
                            <div class="card-header">
                                Registered User
                            </div>
                            <ul class="list-group list-group-flush">
                                @forelse ($roles as $role)
                                    <li class="list-group-item">{{ $role->name }} : {{ $role->users_count }}</li>
                                @empty

                                @endforelse
                                <li class="list-group-item">Total: {{ $roles->sum('users_count') }}</li>
                            </ul>
                        </div>
                    </div>

                    {{-- FIXME:Weekly Completed Job --}}
                    <div class="col-md-6 p-0">
                        <div class="card">
                            <div class="card-header">
                                Weekly Completed Job (Unfinished)
                            </div>
                            <div id="weekly_completed_job" class=""></div>
                        </div>
                    </div>

                    {{-- FIXME:Today Jobs --}}
                    <div class="col-md-4 ps-2">
                        <div class="card">
                            <div class="card-header">
                                Today Jobs (Unfinished)
                            </div>
                            <div  id="today_jobs" class=""></div>
                        </div>
                    </div>
                </div>

                {{-- FIXME:Equipment type --}}
                <div class="col-md-12 p-0 mt-2">
                    <div class="card">
                        <div class="card-header">
                            Equipment Type
                        </div>
                        <div id="type_chart" class=""></div>
                    </div>
                </div>

                {{-- monthly Order --}}
                <div class="card mt-2" style="">
                    <div class="card-header">
                        monthly Order
                    </div>
                    <ul class="list-group list-group-flush">
                        <div class="list-group-item" id="monthly_order"></div>
                    </ul>
                </div>

                {{-- Login history --}}
                <div class="card mt-2" style="">
                    <div class="card-header d-flex justify-content-between align-items-center pe-2">
                        Login History
                        {{-- search bar --}}
                        <form type="get" action="admin/role-permission-search">
                            <div class="input-group">
                                <input type="search" class="form-control" name="query" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
                            </div>
                        </form>
                    </div>
                    <div style="width:100%;overflow:auto; max-height:200px;">{{-- scroll bar based on max-height --}}
                        <table class="table">
                            <th>Name</th>
                            <th>role</th>
                            <th>Last Login</th>
                            <th>Previous Login</th>
                            <th>Last IP</th>

                            @forelse ($users as $user)
                            @if ($user->lastSuccessfulLoginAt())
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->getRole() }}</td>
                                    <td>{{ $user->lastSuccessfulLoginAt() }}</td>

                                    @if (empty($user->previousLoginAt()))
                                    <td>N/A</td>
                                    @else
                                    <td>{{ $user->previousLoginAt() }}</td>
                                    @endif
                                    {{-- <td><button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button></td> --}}
                                    <td>{{ $user->lastSuccessfulLoginIp() }}</td>

                                </tr>
                                @endif

                                @empty

                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>


                {{-- FIXME: --}}
                <div class="card mt-2" style="width: 18rem;">
                    <div class="card-header">
                        User Data
                    </div>
                    <ul class="list-group list-group-flush d-flex">
                        @forelse ($logs as $log)

                        <li class="list-group-item">{{ $log }}</li>

                        @empty

                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        jQuery.noConflict( true );
        /* FIXME: */
        // console.log('jQuery works!');
        // $(function () {
        //     $('[data-toggle="popover"]').popover()
        // });
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(todayJobs);
        google.charts.setOnLoadCallback(monthlyOrder);
        google.charts.setOnLoadCallback(weeklyCompletedJob);
        google.charts.setOnLoadCallback(typeChart);

        /* Weekly Completed Job */
        function weeklyCompletedJob() {
            var data = google.visualization.arrayToDataTable([
                ['string', '', { role: 'style' }],
                ['Angel',22, '#5F7C9E'],
                ['Jay', 6, '#EB9E00'],
                ['Lee', 5, '#5F7C9E'],
                ['Chen', 4, '#5F7C9E'],
            ]);

            var options = {
                backgroundColor: 'transparent',
                legend: 'none',

                chartArea: {width: '50%'},
                hAxis: {
                title: 'Number of completed jobs',

                },
                vAxis: {
                textStyle: {
                    fontSize: 18,
                    bold: true,
                    color: '#848484'
                },
                titleTextStyle: {
                    fontSize: 14,
                    bold: true,
                    color: '#848484'
                }
                }
            };
            var chart = new google.visualization.BarChart(document.getElementById('weekly_completed_job'));
            chart.draw(data, options);
        }

        /* Registered User */
        function todayJobs() {
            var data = google.visualization.arrayToDataTable([
                    ['Job', 'Count'],
                    ['Assigned',     11],
                    ['UnAssigned',    30],
            ]);

            var options = {
                title: 'Job left: 30',
                colors : ['#EB9E00', '5F7C9E'],
                pieHole: 0.4,
                pieSliceText: 'none',
            };

            var chart = new google.visualization.PieChart(document.getElementById('today_jobs'));

            chart.draw(data, options);
        }

        /* monthly Order */
        function monthlyOrder() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Months');
            data.addColumn('number', 'Jobs');
            /* [數量, 月數] */
            data.addRows([

                @php
                    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                    for($i = 0; $i < 12 ; $i++)
                    {
                        echo "['.$months[$i].', ".$monthlyOrders[$i]."],";
                    }
                @endphp

            ]);

            var options = {
                hAxis: {
                    title: @php
                        echo date("Y");
                    @endphp,
                },
                vAxis: {
                title: 'Quantity'
                },
                backgroundColor: 'transparent',
            };

            var chart = new google.visualization.LineChart(document.getElementById('monthly_order'));
            chart.draw(data, options);
        }

        function typeChart() {
            var opacity = 'opacity: 0.4';
            var data = google.visualization.arrayToDataTable([
                ['year', 'Ducted System', 'Mini VRF', 'Package', 'Spilt System',
                'Watercool Unit', 'Other', { role: 'style' } ],
                @php
                    for($y = 0; $y<3; $y++)
                    {
                        echo "[".$typeChart[$y*7].", ".$typeChart[$y*7+1].", ".$typeChart[$y*7+2].", ".$typeChart[$y*7+3].", ".$typeChart[$y*7+4].", ".$typeChart[$y*7+5].", ".$typeChart[$y*7+6].", ''],";
                    }
                @endphp
            ]);
            var options = {
                legend: { position: 'top', maxLines: 3 },
                bar: { groupWidth: '85%' },
                isStacked: true,

            };

            var chart = new google.visualization.BarChart(document.getElementById('type_chart'));
            chart.draw(data, options);
        }
    </script>

@endpush
