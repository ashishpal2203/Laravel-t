@extends('layout')

@section('content')
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3>All user's list</h3>
                    <div class="card p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Education</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->age }}</td>
                                        <td>{{ $user->education }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="piechart" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    @php
        $users = $users->filter(function ($user) {
            return $user !== null && isset($user->age);
        });

        $ageData = $users
            ->map(function ($user) {
                return optional(\Carbon\Carbon::parse($user->age))->age;
            })
            ->filter()
            ->groupBy(function ($age) {
                if ($age < 24) {
                    return 'Below 24';
                } elseif ($age <= 40) {
                    return '18 to 40';
                } else {
                    return 'Above 40';
                }
            })
            ->map->count();
    @endphp

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Age Group', 'Number of Users'],
                ['Below 24', {{ $ageData['Below 18'] ?? 0 }}],
                ['18 to 40', {{ $ageData['18 to 40'] ?? 1 }}],
                ['Above 40', {{ $ageData['Above 40'] ?? 1 }}]
            ]);

            var options = {
                title: '',
                is3D: false,


            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
@endsection
