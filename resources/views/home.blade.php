@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div  id="piechart" class="" style="width: 900px; height: 500px;"></div>
                <div id="chart_div"></div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(userChart);
        google.charts.setOnLoadCallback(monthChart);

        /* Registered User number */
        function userChart() {
            var data = google.visualization.arrayToDataTable([
                ['Role', 'Count'],

                    @php
                    foreach($roles as $r) {
                        echo "['".$r->name."', ".$r->users_count."],";
                    }
                    @endphp
            ]);

            var options = {
                backgroundColor: 'transparent',
                title: 'User Count',
                is3D: false,
                pieSliceText: 'label',
                legend: 'none'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

        function monthChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Months');
            data.addColumn('number', 'Jobs');
            /* [數量, 月數] */
            data.addRows([

                @php
                    echo "['Jan', ".$months[0]."],";
                    echo "['Feb', ".$months[1]."],";
                    echo "['Mar', ".$months[2]."],";
                    echo "['Apr', ".$months[3]."],";
                    echo "['May', ".$months[4]."],";
                    echo "['Jun', ".$months[5]."],";
                    echo "['Jul', ".$months[6]."],";
                    echo "['Aug', ".$months[7]."],";
                    echo "['Sep', ".$months[8]."],";
                    echo "['Oct', ".$months[9]."],";
                    echo "['Nov', ".$months[10]."],";
                    echo "['Dec', ".$months[11]."],";
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

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

@endpush
