@extends("layout")

@section("content")

<div class="dashboard">
   <div class="container">
    <div class="row">
        <div class="col-lg-6">
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

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['DOCTOR', 5],
            ['PATIENT', 7],
            ['LAB', 50],
            ['PHARMA', 178],
        ]);

        var options = {
            title: '',
            is3D: true,
            //   pieHole: 0.4,

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>
@endsection

