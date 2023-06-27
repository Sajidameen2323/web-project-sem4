<x-layout>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #taskProgressChartContainer {
            /* width: 50vw;
            margin: 0 auto; */
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var taskData = [
          
            ];

            var tasks = {{ Js::from($tasks) }};

            tasks.forEach(element => {
                
                taskData.push({
                    taskId: element.id,
                    taskName: element.title,
                    assignedTo: element.employee_name,
                    startDate: element.created_at,
                    endDate: element.target_date,
                    status: element.state
                });
            });

            var taskNames = taskData.map(function(task) {
                return task.taskName;
            });
            var taskStatuses = taskData.map(function(task) {
                return task.status;
            });

            var ctx = document.getElementById('taskProgressChart').getContext('2d');
            var taskProgressChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: taskNames,
                    datasets: [{
                        label: 'Task Progress',
                        data: taskStatuses.map(function(status) {
                            if (status === 'Pending') return 0;
                            if (status === 'In Progress') return 50;
                            if (status === 'Completed') return 100;
                        }),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
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

        <div id="taskProgressChartContainer" class="md:w-1/2">
            <canvas id="taskProgressChart"></canvas>
        </div>


</x-layout>