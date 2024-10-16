<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * frontend/views/predicciones/
 * **/

class PrediccionesController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
