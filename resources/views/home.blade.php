@extends('layouts.app')

@section('content')
    <div class="container">
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

                        {{-- Weekly Completed Job --}}
                        <div class="col-md-6 p-0">
                            <div class="card">
                                <div class="card-header">
                                    Weekly Completed Job (Unfinished)
                                </div>
                                @if ($weeklyName != null)
                                    <div id="weekly_completed_job" class=""></div>
                                @else
                                    No data
                                @endif
                            </div>
                        </div>

                        {{-- Today Jobs --}}
                        <div class="col-md-4 ps-2">
                            <div class="card">
                                <div class="card-header">
                                    Today Jobs (Unfinished)
                                </div>
                                @if ($orderAssignQuantity != null)
                                    <div  id="today_jobs"></div>
                                @else
                                    No data
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Equipment type --}}
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
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(todayJobs);
        google.charts.setOnLoadCallback(monthlyOrder);
        google.charts.setOnLoadCallback(weeklyCompletedJob);
        google.charts.setOnLoadCallback(equipmentChart);

        function weeklyCompletedJob() {
            var data = google.visualization.arrayToDataTable([
                        ['name', 'number', { role: 'style' }],

                @php
                    for($i = 0; $i < count($weeklyCount) ; $i++)
                    {
                        echo "['$weeklyName[$i]' , ".$weeklyCount[$i].", '5F7C9E'],";
                    }
                @endphp
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
                /* orderAssignQuantity */
                    ['Job', 'Count'],
                    @php
                        if($orderAssignQuantity != null)
                        {
                            echo "['Assigned', ".$orderAssignQuantity[1]."],";
                            echo "['UnAssigned', ".$orderAssignQuantity[0]."],";
                        }
                    @endphp
            ]);

            var options = {
                title: @php
                    if($orderAssignQuantity != null)
                    {
                        echo strval($orderAssignQuantity[1]/$orderAssignQuantity[0] * 100);
                    }
                    else
                    {
                        echo 'nodata';
                    }

                @endphp,
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
                        echo "['$months[$i]', ".$monthlyOrders[$i]."],";
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

        function equipmentChart() {
            var opacity = 'opacity: 0.4';
            var data = google.visualization.arrayToDataTable([
                ['year', 'Ducted System', 'Mini VRF', 'Package', 'Spilt System',
                'Watercool Unit', 'Other', { role: 'style' } ],

                @php
                    for($y = 0; $y<3; $y++)
                    {
                        echo "[".$equipmentChart[$y*7].", ".$equipmentChart[$y*7+1].", ".$equipmentChart[$y*7+2].", ".$equipmentChart[$y*7+3].", ".$equipmentChart[$y*7+4].", ".$equipmentChart[$y*7+5].", ".$equipmentChart[$y*7+6].", ''],";
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
