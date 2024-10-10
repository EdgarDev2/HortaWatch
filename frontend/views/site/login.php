<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Iniciar sesión';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1 class="display-5"><?= Html::encode($this->title) ?></h1>

    <p class="text-muted">Por favor, rellene los siguientes campos para iniciar sesión:</p>

    <div class="row">
        <div class="col-md-6 d-flex flex-column justify-content-center p-3">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="my-1 mx-0 mt-4 text-muted">
                Si olvidó su contraseña puede:
                <?= Html::a('Recuperar contraseña', ['site/request-password-reset'], ['class' => 'btn btn-outline-warning border-0']) ?>
                <div class="mt4-"></div>
                ¿Necesita un nuevo correo electrónico de verificación?
                <?= Html::a(' Reenviar verificación', ['site/resend-verification-email'], ['class' => 'btn btn-outline-primary border-0']) ?>
                <div class="form-group mt-4">
                    <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>