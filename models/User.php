<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "arts_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $fname
 * @property string $lname
 * @property string $position
 * @property string $department
 * @property string $sex
 * @property string $code
 * @property string $level
 * @property string $email
 * @property string $tel
 * @property string $image
 * @property string $created_date
 * @property string $status
 */
class User extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sso_user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'password','title','firstname','surname', 'position_name', 'depart_id'], 'required'],
            //[['sex', 'level', 'status'], 'string'],
            //[['created_date'], 'safe'],
            [['title','username', 'password', 'position_name', 'depart_id', 'email','nickname'], 'string', 'max' => 255],
            [['firstname', 'surname'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 20],
            [['tel'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'ชื่อผู้ใช้งาน ',
            'password' => 'รหัสผ่าน ',
            'title' => 'คำนำหน้าชื่อ',
            'firstname' => 'ชื่อ',
            'surname' => 'สกุล',
            'nickname' => 'ชื่อเล่น',
            'position_name' => 'ตำแหน่ง',
            'depart_id' => 'หน่วยงาน',
            //'sex' => 'เพศ',
            'code' => 'Code',
            //'level' => 'ระดับเข้าใช้งาน',
            'email' => 'Email',
            'tel' => 'เบอร์โทรศัพฑ์',
            //'image' => 'Image',
            //'created_date' => 'Created Date',
            //'status' => 'สถานะ',
            'memberValues' => 'หน่วยงาน',
        ];
    }

    public function getMemberValues() {
        return $this->hasOne(Depart::className(), ['code' => 'depart_id']);
    }

}
