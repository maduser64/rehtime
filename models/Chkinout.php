<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chkinout".
 *
 * @property integer $userid
 * @property string $checktime
 * @property string $checktype
 */
class Chkinout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_chkinout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['checktype'], 'required'],
            //[['userid'], 'integer'],
            [['checktime','checktype','userid'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    
    public function attributeLabels()
    {
        return [
            'userid' => 'ชื่อ นามสกุล',
            'checktime' => 'วันที่',
            'checktype' => 'เข้า ออก ',
            'scan_id_location' => 'สถานที่ ',
        ];
    }
    
    public function getUserValues() {
        return $this->hasOne(Userinfo::className(), ['badgenumber' => 'userid']);
    }

    public function getLocation() {
        return $this->hasOne(Scanlocation::className(), ['scan_id' => 'scan_id_location']);
    }
    
}
