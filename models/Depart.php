<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sso_depart".
 *
 * @property integer $id
 * @property integer $faculty_id
 * @property string $code
 * @property string $name
 * @property integer $scandepart_id
 */
class Depart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sso_depart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_id', 'scandepart_id'], 'integer'],
            [['code'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faculty_id' => 'Faculty ID',
            'code' => 'Code',
            'name' => 'Name',
            'scandepart_id' => 'Scandepart ID',
        ];
    }
}
