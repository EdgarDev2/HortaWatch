<?php
$this->title = 'Gráficas';

use yii\helpers\Html;

$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
?>
<div class="graficas-index">
    <h1 class="display-6 text-success text-left"><?= Html::encode($this->title) ?></h1>
    <p class="text-success text-left">Visualización de la humedad del suelo en tiempo real durante los últimos 20 minutos.</p>
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

        const dataCama1 = <?= json_encode($dataCama1) ?>;
        const dataCama2 = <?= json_encode($dataCama2) ?>;
        const dataCama3 = <?= json_encode($dataCama3) ?>;
        const dataCama4 = <?= json_encode($dataCama4) ?>;

        function obtenerDatos(data) {
            return {
                fechas: data.map(item => item.hora),
                humedad: data.map(item => item.humedad)
            };
        }

        // Datos para cama 1
        const ultimosDatosCama1 = dataCama1.slice(-20);
        const {
            fechas: fechasCama1,
            humedad: humedadCama1
        } = obtenerDatos(ultimosDatosCama1);
        let dataValuesCama1 = [...humedadCama1];

        // Datos para cama 2
        const ultimosDatosCama2 = dataCama2.slice(-20);
        const {
            fechas: fechasCama2,
            humedad: humedadCama2
        } = obtenerDatos(ultimosDatosCama2);
        let dataValuesCama2 = [...humedadCama2];

        // Datos para cama 3
        const ultimosDatosCama3 = dataCama3.slice(-20);
        const {
            fechas: fechasCama3,
            humedad: humedadCama3
        } = obtenerDatos(ultimosDatosCama3);
        let dataValuesCama3 = [...humedadCama3];

        // Datos para cama 4
        const ultimosDatosCama4 = dataCama4.slice(-20);
        const {
            fechas: fechasCama4,
            humedad: humedadCama4
        } = obtenerDatos(ultimosDatosCama4);
        let dataValuesCama4 = [...humedadCama4];

        // Función para crear la gráfica
        function crearGrafica(ctx, labels, dataValues, label) {
            return new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        backgroundColor: Utils.randomColor(0.2),
                        borderColor: Utils.randomColor(1),
                        pointBackgroundColor: Utils.randomColor(1),
                        data: dataValues,
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
        crearGrafica(document.getElementById('myChart1').getContext('2d'), fechasCama1, dataValuesCama1, 'Ka\'anche\' 1 automatizado');
        crearGrafica(document.getElementById('myChart2').getContext('2d'), fechasCama2, dataValuesCama2, 'Ka\'anche\' 2 automatizado');
        crearGrafica(document.getElementById('myChart3').getContext('2d'), fechasCama3, dataValuesCama3, 'Ka\'anche\' 3 manual');
        crearGrafica(document.getElementById('myChart4').getContext('2d'), fechasCama4, dataValuesCama4, 'Ka\'anche\' 4 manual');

        // Llamada a la función de descarga para cada gráfica
        descargarGrafica('myChart1', 'downloadChart1', 'grafica_cama1.png');
        descargarGrafica('myChart2', 'downloadChart2', 'grafica_cama2.png');
        descargarGrafica('myChart3', 'downloadChart3', 'grafica_cama3.png');
        descargarGrafica('myChart4', 'downloadChart4', 'grafica_cama4.png');
    </script>