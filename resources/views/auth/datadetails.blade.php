<x-dashboard>
    <x-slot:titulo>Detalles Estudiantes</x-slot:titulo>
    <x-title-section-admin>
        Datos Más Detallados
    </x-title-section-admin>

    <div class="border border-gray-400 rounded-lg my-4">
        <div class="py-10 sm:py-10 text-center">
            <h2 class="text-3xl font-bold tracking-tight sm:text-4xl font-inter">Métricas por cada carrera</h2>
            <div>
                <canvas id="miGrafico"></canvas>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const graficoPorCarrera = @json($graficoPorCarrera ?? []); // Usar null coalescing para prevenir errores

                    if (Object.keys(graficoPorCarrera).length === 0 || graficoPorCarrera.labels.length === 0) {
                        // Opcional: Mostrar un mensaje si no hay datos
                        const contenedor = document.getElementById('miGrafico').parentNode;
                        contenedor.innerHTML = '<p class="text-xl text-gray-500">No hay estudiantes registrados en este núcleo.</p>';
                        return; // Detener la ejecución del gráfico si no hay datos
                    }

                    // Extraer los datos necesarios
                    const labels = graficoPorCarrera.labels;
                    const dataHombres = graficoPorCarrera.hombres;
                    const dataMujeres = graficoPorCarrera.mujeres;

                    const ctx = document.getElementById('miGrafico');
                    const datos = {
                        labels: labels,
                        datasets: [{
                            label: 'Mujeres',
                            data: dataMujeres,
                            backgroundColor: 'rgba(217, 67, 168, 1)',
                            borderColor: 'rgba(217, 67, 168, 1)',
                            borderWidth: 1,
                            barThickness: 30,
                            borderRadius: 10,
                        }, {
                            label: 'Hombres',
                            data: dataHombres,
                            backgroundColor: 'rgba(66, 114, 216, 1)',
                            borderColor: 'rgba(66, 114, 216, 1)',
                            borderWidth: 1,
                            barThickness: 30,
                            borderRadius: 10
                        }]
                    };

                    const configuracion = {
                        type: 'bar',
                        data: datos,
                        options: {
                            responsive: true,
                            indexAxis: 'y',
                            scales: {
                                x: { // Cambiado a 'x' si indexAxis es 'y'
                                    beginAtZero: true
                                },
                                // Opcional: para que se vean mejor las etiquetas largas
                                y: {
                                    ticks: {
                                        autoSkip: false,
                                        maxRotation: 0,
                                        minRotation: 0
                                    }
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Género por Carrera'
                                }
                            }
                        }
                    };

                    const miGrafico = new Chart(
                        ctx,
                        configuracion
                    );
                });
            </script>

        </div>
    </div>

    <center>
        <x-button-a link="download-student-list" icon="fas fa-file-download">Descargar Resumen</x-button-a>
    </center>
</x-dashboard>
