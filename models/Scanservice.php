<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scan_service".
 *
 * @property integer $service_id
 * @property integer $user_id
 * @property integer $depart_id
 */
class Scanservice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'depart_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'service_id' => 'Service ID',
            'user_id' => 'ชื่อ นามสกุล',
            'depart_id' => 'หน่วยงาน',
        ];
    }

    public function getDepart()
    {
        return $this->hasOne(Department::className(), ['deptid' => 'depart_id']);
    }

     public function getUser()
    {
        return $this->hasOne(Userinfo::className(), ['badgenumber' => 'user_id']);
    }
}
