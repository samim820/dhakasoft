<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Traffic Graph</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>

<canvas id="trafficChart" width="400" height="200"></canvas>

<script>
$(document).ready(function() {
    // Initialize the Chart.js configuration
    var ctx = document.getElementById('trafficChart').getContext('2d');
    var trafficChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Traffic',
                data: [],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Function to update the traffic chart
    function updateTrafficChart() {
        $.ajax({
            url: 'config.php',
            dataType: 'json',
            success: function(data) {
                // Extract relevant data from the API response
                var time = new Date().toLocaleTimeString();
                var trafficValue = data[0]['tx-bits-per-second'];

                // Add new data point to the chart
                trafficChart.data.labels.push(time);
                trafficChart.data.datasets[0].data.push(trafficValue);

                // Limit the number of data points displayed (adjust as needed)
                var maxDataPoints = 10;
                if (trafficChart.data.labels.length > maxDataPoints) {
                    trafficChart.data.labels.shift();
                    trafficChart.data.datasets[0].data.shift();
                }

                // Update the chart
                trafficChart.update();

                // Schedule the next update (adjust the interval as needed)
                setTimeout(updateTrafficChart, 1000);
            },
            error: function(error) {
                console.error('Error fetching traffic data:', error);
                // Retry the update after a delay in case of an error
                setTimeout(updateTrafficChart, 5000);
            }
        });
    }

    // Start updating the traffic chart
    updateTrafficChart();
});
</script>

</body>
</html>
