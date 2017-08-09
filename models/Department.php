<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property integer $deptid
 * @property string $deptname
 * @property integer $subdeptid
 * @property integer $intime_id
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deptname','intime_id'], 'required'],
            [['deptid', 'subdeptid', 'intime_id'], 'integer'],
            [['deptname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'deptid' => 'Deptid',
            'deptname' => 'ชื่อหน่วยงาน',
            'subdeptid' => 'Subdeptid',
            'intime_id' => 'ช่วงเวลา ทำงาน',
        ];
    }

    public function getDeparttime()
    {
        return $this->hasOne(ScanIntime::className(), ['deptid' => 'defaultdepid']);
    }
}
