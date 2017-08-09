<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userinfo".
 *
 * @property integer $userid
 * @property integer $badgenumber
 * @property string $name
 * @property integer $defaultdepid
 */
class Userinfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_userinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['badgenumber', 'name', 'defaultdepid'], 'required'],
            [['userid', 'badgenumber', 'defaultdepid'], 'integer'],
            [['name','title','beloag','cotton','address','position'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userid' => 'Userid',
            'badgenumber' => 'รหัสลายนิ้วมือ',
            'name' => 'ชื่อ นามสกุล',
            'defaultdepid' => 'หน่วยงาน',
            'title' => 'คำนำหน้า',
            'beloag' => 'สังกัด',
            'cotton' => 'ฝ่าย',
            'address' => 'ที่อยู่',
            'position' => 'ตำแหน่ง'
        ];
    }
    
     public function getDepart()
    {
        return $this->hasOne(Department::className(), ['deptid' => 'defaultdepid']);
    }
}
