@props(['graficoGeneros'])

@vite(['resources/js/chart.js'])

<div class="container">
    <canvas id="myChart"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Recibir los datos desde Laravel
        const graficoGeneros = @json($graficoGeneros);

        // Extraer valores
        const dataHombres = graficoGeneros.hombres;
        const dataMujeres = graficoGeneros.mujeres;

        // Crear gráfico
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Hombres', 'Mujeres'],
                datasets: [{
                    data: [dataHombres, dataMujeres],
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
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            },
        });
    });
</script>

