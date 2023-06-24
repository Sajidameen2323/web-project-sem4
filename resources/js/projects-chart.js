import Chart from 'chart.js';

document.addEventListener('DOMContentLoaded', function() {
    // Retrieve the chart data from the Laravel route
    fetch('/projects/chart')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('projectsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Project Count',
                        data: data.data,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
