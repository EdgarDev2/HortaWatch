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
        // Obtener datos de cada cama
        $dataCama1 = Cama1::find()->select(['humedad', 'fecha', 'hora'])->asArray()->all();
        $dataCama2 = Cama2::find()->select(['humedad', 'fecha', 'hora'])->asArray()->all();
        $dataCama3 = Cama3::find()->select(['humedad', 'fecha', 'hora'])->asArray()->all();
        $dataCama4 = Cama4::find()->select(['humedad', 'fecha', 'hora'])->asArray()->all();

        // Pasar los datos a la vista
        return $this->render('index', [
            'dataCama1' => $dataCama1,
            'dataCama2' => $dataCama2,
            'dataCama3' => $dataCama3,
            'dataCama4' => $dataCama4,
        ]);
    }
}
