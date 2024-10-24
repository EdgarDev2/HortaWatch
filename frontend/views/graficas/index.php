<?php
$this->title = 'Gráficas';

use yii\helpers\Html;

$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
?>
<div class="graficas-index">
    <h1 class="display-6 text-success text-left"><?= Html::encode($this->title) ?></h1>
    <p class="text-success text-left"><?= $fechaActual ?>: promedio de Humedad por Hora</p>
    <hr class="border border-success">

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card" style="border: 2px solid #D3ECE1;">
                <div class="card-body position-relative">
                    <button id="downloadChart1" class="btn btn-link position-absolute" style="top: 10px; right: 10px;" title="Descargar gráfica">
                        <i class="fas fa-download text-success"></i>
                    </button>
                    <canvas id="myChart1" style="width: 100%; height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card" style="border: 2px solid #D3ECE1;">
                <div class="card-body position-relative">
                    <button id="downloadChart2" class="btn btn-link position-absolute" style="top: 10px; right: 10px;" title="Descargar gráfica">
                        <i class="fas fa-download text-success"></i>
                    </button>
                    <canvas id="myChart2" style="width: 100%; height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card" style="border: 2px solid #D3ECE1;">
                <div class="card-body position-relative">
                    <button id="downloadChart3" class="btn btn-link position-absolute" style="top: 10px; right: 10px;" title="Descargar gráfica">
                        <i class="fas fa-download text-success"></i>
                    </button>
                    <canvas id="myChart3" style="width: 100%; height: 400px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card" style="border: 2px solid #D3ECE1;">
                <div class="card-body position-relative">
                    <button id="downloadChart4" class="btn btn-link position-absolute" style="top: 10px; right: 10px;" title="Descargar gráfica">
                        <i class="fas fa-download text-success"></i>
                    </button>
                    <canvas id="myChart4" style="width: 100%; height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Incluyendo el plugin de zoom para Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@2.0.0/dist/chartjs-plugin-zoom.min.js"></script>-->
    <script>
        const Utils = {
            randomColor: function(alpha) {
                const baseColors = [25, 135, 84];
                const randomColor = () => baseColors.map(base => Math.floor(base + Math.random() * 30));
                return `rgba(${randomColor().join(', ')}, ${alpha})`;
            },
        };

        // Recuperar los datos promediados del controlador
        const resultados = <?= json_encode($resultados) ?>;

        // Función para obtener las horas y los promedios de humedad
        function obtenerDatos(data, camaIndex) {
            return {
                fechas: data.map(item => {
                    // Formato 24hrs (ej: 14:00, 15:00, ...)
                    const hora = item.hora; // Obtiene la hora directamente
                    return `${hora}:00`; // Devuelve la hora en formato "HH:MM"
                }),
                humedad: data.map(item => item[`promedio_humedad_cama${camaIndex}`] || 0) // Usamos 0 en lugar de null
            };
        }

        // Datos para cada cama
        const {
            fechas: fechasCama1,
            humedad: humedadCama1
        } = obtenerDatos(resultados, 1);

        const {
            fechas: fechasCama2,
            humedad: humedadCama2
        } = obtenerDatos(resultados, 2);

        const {
            fechas: fechasCama3,
            humedad: humedadCama3
        } = obtenerDatos(resultados, 3);

        const {
            fechas: fechasCama4,
            humedad: humedadCama4
        } = obtenerDatos(resultados, 4);

        // Función para crear la gráfica
        function crearGrafica(ctx, labels, dataValues, label) {
            return new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels, // Las horas
                    datasets: [{
                        label: label,
                        backgroundColor: Utils.randomColor(0.2),
                        borderColor: Utils.randomColor(1),
                        pointBackgroundColor: Utils.randomColor(1),
                        data: dataValues, // Los promedios de humedad
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 10,
                            },
                            angleLines: {
                                color: 'green',
                            }
                        }
                    },
                    elements: {
                        line: {
                            borderWidth: 2
                        }
                    }
                }
            });
        }

        // Función para descargar el gráfico como imagen
        function descargarGrafica(idCanvas, idBoton, nombreArchivo) {
            document.getElementById(idBoton).addEventListener('click', function() {
                const canvas = document.getElementById(idCanvas);
                const enlace = document.createElement('a');
                enlace.href = canvas.toDataURL('image/png'); // Convierte el gráfico en imagen PNG
                enlace.download = nombreArchivo; // Nombre del archivo que se descargará
                enlace.click(); // Ejecuta el clic para descargar la imagen
            });
        }

        // Crear las gráficas
        crearGrafica(document.getElementById('myChart1').getContext('2d'), fechasCama1, humedadCama1, 'Ka\'anche\' 1 automatizado');
        crearGrafica(document.getElementById('myChart2').getContext('2d'), fechasCama2, humedadCama2, 'Ka\'anche\' 2 automatizado');
        crearGrafica(document.getElementById('myChart3').getContext('2d'), fechasCama3, humedadCama3, 'Ka\'anche\' 3 manual');
        crearGrafica(document.getElementById('myChart4').getContext('2d'), fechasCama4, humedadCama4, 'Ka\'anche\' 4 manual');

        // Llamada a la función de descarga para cada gráfica
        descargarGrafica('myChart1', 'downloadChart1', 'grafica_cama1.png');
        descargarGrafica('myChart2', 'downloadChart2', 'grafica_cama2.png');
        descargarGrafica('myChart3', 'downloadChart3', 'grafica_cama3.png');
        descargarGrafica('myChart4', 'downloadChart4', 'grafica_cama4.png');
    </script>