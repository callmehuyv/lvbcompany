<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "drivers".
 *
 * @property string $driver_id
 * @property integer $company_id
 * @property string $driver_name
 * @property string $driver_address
 * @property string $driver_image
 * @property string $driver_phone
 * @property integer $record_status
 *
 * @property Companies $company
 * @property Vehicles[] $vehicles
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'drivers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'driver_name', 'driver_address', 'driver_image', 'driver_phone'], 'required'],
            [['company_id', 'record_status'], 'integer'],
            [['driver_name', 'driver_address', 'driver_image', 'driver_phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'driver_id' => 'Driver ID',
            'company_id' => 'Company ID',
            'driver_name' => 'Driver Name',
            'driver_address' => 'Driver Address',
            'driver_image' => 'Driver Image',
            'driver_phone' => 'Driver Phone',
            'record_status' => 'Record Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['company_id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicle::className(), ['driver_id' => 'driver_id']);
    }
}