<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scan_leave_report".
 *
 * @property integer $leave_id
 * @property integer $userid
 * @property integer $depart
 * @property integer $leavetype_id
 * @property string $date
 * @property string $date_end
 * @property string $leave_save
 * @property integer $status
 * @property string $commend
 * @property string $commend1
 * @property string $leave_beloag
 * @property string $leave_cotton
 * @property string $leave_address
 * @property string $leave_ass
 * @property string $leave_position
 */
class Scanleavereport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scan_leave_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'depart', 'leavetype_id', 'status'], 'integer'],
            [['date', 'date_end'], 'safe'],
            [['leave_address'], 'string'],
            [['leave_save', 'commend', 'commend1', 'leave_beloag', 'leave_cotton', 'leave_ass', 'leave_position','leave_cause'], 'string', 'max' => 255],
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
            'date_end' => 'วันที่สิ้นสุด',
            'leave_save' => 'Leave Save',
            'status' => 'Status',
            'commend' => 'Commend',
            'commend1' => 'Commend1',
            'leave_beloag' => 'Leave Beloag',
            'leave_cotton' => 'Leave Cotton',
            'leave_address' => 'Leave Address',
            'leave_ass' => 'Leave Ass',
            'leave_position' => 'Leave Position',
            'leave_cause' => 'สาเหตุการลา'
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
