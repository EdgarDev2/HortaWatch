<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Inicio';

?>

<div class="site-index">
    <div class="body-content">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="row w-100">
                <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
                    <div class="text text-center text-md-start">
                        <h1 class="display-4 text-dark">MONITOREO WEB EN TIEMPO REAL DE HORTALIZAS</h1>
                        <p class="lead text-dark">En el Instituto Tecnológico Superior de Valladolid se elaboró este proyecto con el fin monitorear
                            las variables ambientales cruciales...</p>
                        <div class="buttons mt-4">
                            <?= Html::a('SEGUIR LEYENDO', ['/site/about'], ['class' => 'btn btn-outline-success btn-lg']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-center align-items-center mt-4 mt-md-0">
                    <div class="image position-relative">
                        <?= Html::img('@web/images/cilantro.png', ['class' => 'img-fluid rounded', 'alt' => Yii::$app->name]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>