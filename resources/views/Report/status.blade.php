<x-layout>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var app = {{ Js::from($tasks) }};
        console.log(app);

        var statusArr = ['Pending', 'In Progress', 'Completed', 'Removed'];
        var tempArr = [
            ['Status', 'No. Of Tasks'],
        ]
        statusArr.forEach(status=>{

            let val = 0;
            app.forEach((el)=>{

                if(el.state === status){
                    val = el.total;
                    
                }
            });
            tempArr.push([status, val]);
        });
        console.log(tempArr);
        var data = google.visualization.arrayToDataTable(tempArr);

        var options = {
          title: 'Tasks status',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <div class="mx-auto ">
    <a href="{{ route('projects.reports',$project_id) }}" class="inline-block mb-4">
        <button class="flex items-center px-4 py-2 bg-green-500 text-white rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Reports
        </button>
    </a>

    <div id="donutchart" style="width: 900px; height: 500px;"></div>

</x-layout>