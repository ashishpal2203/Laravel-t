@extends("layout")

@section("content")

<div class="dashboard">
   <div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h3>All user's list</h3>
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
        <div class="col-lg-6">
            <div id="piechart"></div>
        </div>
    </div>
   </div>
</div>

@php
    $ageData = $users->map(function ($user) {
        $user->age = \Carbon\Carbon::parse($user->age)->age;
    })->groupBy(function ($user) {
        if ($user->age < 18) {
            return 'Below 18';
        } elseif ($user->age <= 40) {
            return '18 to 40';
        } else {
            return 'Above 40';
        }
    })->map->count(); 
@endphp

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Age Group', 'Number of Users'],
            ['Below 18', {{ $ageData['Below 18'] ?? 0 }}],
            ['18 to 40', {{ $ageData['18 to 40'] ?? 0 }}],
            ['Above 40', {{ $ageData['Above 40'] ?? 0 }}]
        ]);

        var options = {
            title: '',
            is3D: true,


        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
@endsection

