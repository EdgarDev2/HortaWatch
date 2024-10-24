<?php

namespace frontend\controllers;

use frontend\models\Cama1;
use frontend\models\Cama2;
use frontend\models\Cama3;
use frontend\models\Cama4;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * frontend/views/graficas/
 * **/

class GraficasController extends Controller
{
    public function behaviors()
    {
        return [
            // Filtro de control de acceso
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'], // Acciones a restringir
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // '@' solo usuarios autenticados tienen acceso
                    ],
                ],
            ],
            // Filtro de control de verbos HTTP
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'], // La acción 'delete' solo puede ser accedida mediante POST
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $fechaActual = '2024-09-06'; // Fecha específica

        // Inicializa un arreglo para las horas del día
        $horasDelDia = range(0, 23);

        // Crear un arreglo para almacenar los resultados finales
        $resultados = [];

        // Obtener promedios de humedad por hora para Cama 1
        $dataCama1 = Cama1::find()
            ->select(['HOUR(hora) as hora', 'AVG(humedad) as promedio_humedad'])
            ->where(['fecha' => $fechaActual])
            ->groupBy(['HOUR(hora)'])
            ->asArray()
            ->all();

        $promediosCama1 = array_column($dataCama1, 'promedio_humedad', 'hora');

        // Obtener promedios de humedad por hora para Cama 2
        $dataCama2 = Cama2::find()
            ->select(['HOUR(hora) as hora', 'AVG(humedad) as promedio_humedad'])
            ->where(['fecha' => $fechaActual])
            ->groupBy(['HOUR(hora)'])
            ->asArray()
            ->all();

        $promediosCama2 = array_column($dataCama2, 'promedio_humedad', 'hora');

        // Obtener promedios de humedad por hora para Cama 3
        $dataCama3 = Cama3::find()
            ->select(['HOUR(hora) as hora', 'AVG(humedad) as promedio_humedad'])
            ->where(['fecha' => $fechaActual])
            ->groupBy(['HOUR(hora)'])
            ->asArray()
            ->all();

        $promediosCama3 = array_column($dataCama3, 'promedio_humedad', 'hora');

        // Obtener promedios de humedad por hora para Cama 4
        $dataCama4 = Cama4::find()
            ->select(['HOUR(hora) as hora', 'AVG(humedad) as promedio_humedad'])
            ->where(['fecha' => $fechaActual])
            ->groupBy(['HOUR(hora)'])
            ->asArray()
            ->all();

        $promediosCama4 = array_column($dataCama4, 'promedio_humedad', 'hora');

        // Crear un arreglo para almacenar los resultados
        foreach ($horasDelDia as $hora) {
            $resultados[$hora] = [
                'hora' => $hora,
                'promedio_humedad_cama1' => $promediosCama1[$hora] ?? null,
                'promedio_humedad_cama2' => $promediosCama2[$hora] ?? null,
                'promedio_humedad_cama3' => $promediosCama3[$hora] ?? null,
                'promedio_humedad_cama4' => $promediosCama4[$hora] ?? null,
            ];
        }

        // Pasar los datos a la vista
        return $this->render('index', [
            'resultados' => $resultados,
            'fechaActual' => $fechaActual, // Aquí pasas la fecha
        ]);
    }
}
