<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * frontend/views/variables-ambientales/
 * **/

class VariablesAmbientalesController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
