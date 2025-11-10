@vite(['resources/js/chart.js'])
<div class="container">
    <canvas id="myChart"></canvas>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Hombres', 'Mujeres'],
            datasets: [{
                data: [21, 19],
                backgroundColor: [
                    'rgba(48, 40, 255, 0.5)',
                    'rgba(245, 40, 145, 0.5)',
                ],
                borderColor: [
                    'rgba(48, 40, 255, 1)',
                    'rgba(245, 40, 145, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            animation: {
                onComplete: () => {
                delayed = true;
                },
            }
        }
    });
        });
</script>
