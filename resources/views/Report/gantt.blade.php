<x-layout>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['gantt']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var app = {{ Js::from($tasks) }};

            

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Task ID');
            data.addColumn('string', 'Task Name');
            data.addColumn('string', 'Resource');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');

            var tempArr = [
      
            ];
            app.forEach(element => {
                
                let compval = (element.state == "Completed"?100:Math.floor(Math.random() * 101));
           
                tempArr.push([
                    "Task "+element.id,
                    element.title,
                    element.type,
                    new Date(element.created_at),
                    new Date(element.target_date),
                    null,
                    compval,
                    null
                ])
            });
            console.log(tempArr);

            data.addRows(tempArr);
            var options = {
                height: 400
            };

            var chart = new google.visualization.Gantt(document.getElementById('gantt_chart'));
           

            chart.draw(data, options);
        }
    </script>
        <a href="{{ route('projects.reports',$project_id) }}" class="inline-block mb-4">
            <button class="flex items-center px-4 py-2 bg-green-500 text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Reports
            </button>
        </a>
    <div class="my-2">
        <h4 class="text-lg text-gray-800 font-semibold">Gantt Chart</h4>
    </div>
    <div class="mx-auto bg-gray-600 text-gray-200" id="gantt_chart">

    </div>
</x-layout>