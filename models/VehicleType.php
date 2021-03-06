<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vehicletype".
 *
 * @property integer $vehicletype_id
 * @property string $vehicletype_name
 * @property string $vehicletype_description
 * @property string $vehicletype_image
 * @property integer $record_status
 *
 * @property Drivers[] $drivers
 * @property Vehicles[] $vehicles
 */
class Vehicletype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vehicletypes';
    }

    public function rules()
    {
        return [
            [['vehicletype_description'], 'string'],
            [['record_status'], 'integer'],
            [['vehicletype_name', 'vehicletype_image'], 'string', 'max' => 255],
            [['vehicletype_image'], 'file', 'extensions' => 'jpg, gif, png'],
            ['vehicletype_name', 'unique']
        ];
    }

    public function attributeLabels()
    {
        return [
            'vehicletype_id' => 'Vehicletype ID',
            'vehicletype_name' => 'Vehicletype Name',
            'vehicletype_description' => 'Vehicletype Description',
            'vehicletype_image' => 'Vehicletype Image',
            'record_status' => 'Record Status',
        ];
    }

    public function getVehicles()
    {
        return Vehicle::find()
                    ->where(['record_status' => 4, 'vehicletype_id' => $this->vehicletype_id])
                        ->all();
    }

    public function getLines()
    {
        return Line::find()
                    ->where(['record_status' => 4, 'vehicletype_id' => $this->vehicletype_id])
                        ->all();
    }
}
