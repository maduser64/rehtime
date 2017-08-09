<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scan_holiday".
 *
 * @property integer $FisYear
 * @property string $PublicHoliday
 * @property string $Descripiton
 */
class Holiday extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_holiday';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FisYear', 'PublicHoliday', 'Descripiton'], 'required'],
            [['FisYear'], 'integer'],
            [['PublicHoliday'], 'safe'],
            [['Descripiton'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FisYear' => 'ปี',
            'PublicHoliday' => 'วันที่',
            'Descripiton' => 'รายละเอียด',
        ];
    }
}
