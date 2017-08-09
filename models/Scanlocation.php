<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scan_values".
 *
 * @property integer $scan_id
 * @property string $scan_ip
 * @property string $scan_location
 * @property integer $status_id
 * @property string $lest_update
 */
class Scanlocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scan_ip'], 'required'],
            [['scan_id', 'status_id'], 'integer'],
            [['scan_ip'], 'string', 'max' => 20],
            [['scan_location'], 'string', 'max' => 255],
            [['last_update'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scan_id' => 'Scan ID',
            'scan_ip' => 'ไอพี',
            'scan_location' => 'สถานที่ติดตั้งเครื่องแสกน',
            'status_id' => 'สถานะ',
            'last_update' => 'ดูดข้อมูลล่าสุด',
        ];
    }
}
