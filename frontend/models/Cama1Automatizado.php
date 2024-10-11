<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Modelo para la tabla cama1 automatizado.
 */
class Cama1Automatizado extends ActiveRecord
{
    /**
     * Especifica el nombre de la tabla asociada con el modelo.
     *
     * @return string
     */
    public static function tableName()
    {
        return 'cama1'; //Nombre de la tabla en la base de datos
    }

    /**
     * Define las reglas de validación para los atributos del modelo.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['humedad'], 'number'],
            [['fecha', 'hora'], 'safe'], //Asignación masiva sin validación 
        ];
    }

    public static function className()
    {
        return self::class; // Devuelve el nombre de la clase donde se usa 'frontend\models\Cama1Automatizado'
    }

    //etiquetas amigables
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'humedad' => 'Humedad',
            'fecha' => 'Fecha',
            'hora' => 'Hora',
        ];
    }
}
