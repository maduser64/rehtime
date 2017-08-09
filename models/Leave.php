<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scan_leave".
 *
 * @property integer $leave_id
 * @property integer $userid
 * @property integer $depart
 * @property integer $leavetype_id
 * @property string $date
 * @property integer $leave_save
 * @property integer $status
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_leave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['depart', 'leavetype_id','date','userid','status'], 'required'],
            [['userid', 'depart', 'leavetype_id', 'leave_save', 'status','date','commend','commend1',
            'date_end','leave_beloag','leave_cotton','leave_address','leave_ass','leave_position','leave_cause'
            ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'leave_id' => 'Leave ID',
            'userid' => 'ชื่อ นามสกุล',
            'depart' => 'หน่วยงาน',
            'leavetype_id' => 'ประเภทการลา',
            'date' => 'วันที่เริ่มต้น',
            'leave_save' => 'Leave Save',
            'status' => 'วันที่สิ้นสุด',
            'commend' => 'สาเหตุ การชึ้น OT',
            'commend1' => 'สาเหตุ อื่นๆ',
            'leave_cause' => 'เนื่องมาจาก'
        ];
    }

    public function getDepart1()
    {
        return $this->hasOne(Department::className(), ['deptid' => 'depart']);
    }

    public function getLeave()
    {
        return $this->hasOne(Leavetype::className(), ['leavetype_id' => 'leavetype_id']);
    }

     public function getUser()
    {
        return $this->hasOne(Userinfo::className(), ['badgenumber' => 'userid']);
    }
}
