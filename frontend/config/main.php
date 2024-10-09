<?php
//archivo de configuración para la aplicación
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend', //protector de solicitudes Cross-Site Request Forgery
        ],
        //Autentificación del usuario
        'user' => [
            'identityClass' => 'common\models\User', //clase para la identidad del usuario
            'enableAutoLogin' => true, //permite el inicio de sesión automático
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true], //configuración de la cookie de identidad del usuario.
        ],
        //comportamiento de las sesiones
        'session' => [
            'name' => 'advanced-frontend', //nombre de la cookie de sesión que se utiliza para iniciar sesión de forma automática
            'timeout' => 60, //cierre de sesión por inactividad (20 segundos)
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
