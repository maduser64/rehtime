<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scan_intime".
 *
 * @property integer $intime_id
 * @property string $time_A
 * @property string $time_B
 * @property string $time_C
 */
class ScanIntime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_intime';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time_A', 'time_B', 'time_C'], 'required'],
            [['time_A', 'time_B', 'time_C'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'intime_id' => 'Intime ID',
            'time_A' => 'Time  A',
            'time_B' => 'Time  B',
            'time_C' => 'Time  C',
        ];
    }
}
