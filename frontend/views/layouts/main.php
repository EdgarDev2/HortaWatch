<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100"> <!--Indispensable mantener esta clase-->
    <?php $this->beginBody() ?>

    <header>
        <!--Ejecutar lógica del del lado del servidor y generar contenido dinámico-->
        <?php
        NavBar::begin([
            'brandLabel' => Html::img('@web/images/house-fill-light.svg', ['alt' => Yii::$app->name]) . ' ' . Yii::$app->name,
            'brandUrl' => Yii::$app->user->isGuest ? Yii::$app->homeUrl : ['/site/ambientales'], // URL diferente según el estado de autenticación
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-success fixed-top',
            ],
        ]);

        // Array de elementos para nav.
        $menuItems = [];

        // Verificar si el usuario es un invitado (no autenticado)
        if (Yii::$app->user->isGuest) {
            // Si es un invitado, solo mostrar estas opciones
            $menuItems = [
                ['label' => 'Acerca de', 'url' => ['/site/about']],
                ['label' => 'Contacto', 'url' => ['/site/contact']],
                ['label' => 'Registrar Usuario', 'url' => ['/site/signup']],
            ];
        } else {
            // Aquí iría el código para los usuarios autenticados
            $menuItems = [
                ['label' => 'Tiempo Real', 'url' => ['/site/tiemporeal']],
                ['label' => 'Graficas', 'url' => ['/site/graficas']],
                ['label' => 'Predicciones', 'url' => ['/site/predicciones']],
                ['label' => 'Acerca de', 'url' => ['/site/about']],
                ['label' => 'Contacto', 'url' => ['/site/contact']],
            ];
        }
        // Renderizar el menu
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);

        //bloque para iniciar sesión.
        if (Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::a('Iniciar sesión', ['/site/login'], ['class' => ['btn btn-outline-light text-decoration-none']]), ['class' => ['d-flex']]);
        } else {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Bienvenido (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-success bg-transparent border-0 text-light text-decoration-none']
                )
                . Html::endForm();
        }
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
