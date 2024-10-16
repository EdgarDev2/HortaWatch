<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * frontend/views/graficas/
 * **/

class GraficasController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
