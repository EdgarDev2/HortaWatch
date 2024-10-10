<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Crear cuenta';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">

    <h1 class="display-5"><?= Html::encode($this->title) ?></h1>
    <p class="text-muted">Por favor, rellene los siguientes campos para registrarse:</p>

    <div class="row">
        <div class="col-md-6 d-flex flex-column justify-content-center p-3">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Crear cuenta', ['class' => 'btn btn-outline-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>