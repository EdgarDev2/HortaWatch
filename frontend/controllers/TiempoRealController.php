<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * frontend/views/tiempo-real/
 * **/

class TiempoRealController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
