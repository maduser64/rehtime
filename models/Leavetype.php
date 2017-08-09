<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scan_leavetype".
 *
 * @property integer $leavetype_id
 * @property string $leavetype_name
 * @property integer $leavetype_status
 */
class Leavetype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_leavetype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leavetype_status'], 'integer'],
            [['leavetype_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'leavetype_id' => 'Leavetype ID',
            'leavetype_name' => 'ชื่อ ประเภทการลา',
            'leavetype_status' => 'Leavetype Status',
        ];
    }
}
