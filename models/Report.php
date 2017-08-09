<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Report extends Model
{
    public $userid;
    public $deptid;
    public $date_strat;
    public $date_end;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_strat','date_end','userid','deptid'],'required'],
           
        ];
    }

    public function attributeLabels()
    {
        return [
            'userid' => 'ชื่อ สกุล ',
            'deptid' => 'หน่วยงาน ',
            'date_strat' => 'วันที่เริ่มต้น ' ,
            'date_end' => 'วันที่สุด ',
        ];
    }
}
