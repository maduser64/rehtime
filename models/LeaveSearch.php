<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leave;

/**
 * LeaveSearch represents the model behind the search form about `app\models\Leave`.
 */
class LeaveSearch extends Leave
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leave_id', 'depart', 'leavetype_id', 'leave_save', 'status'], 'integer'],
            [['date','userid'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Leave::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //จัดเรียงข้อมูลเริ่มต้น 
            'sort'=> ['defaultOrder' => ['leave_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'leave_id' => $this->leave_id,
            'userid' => $this->userid,
            'depart' => $this->depart,
            'leavetype_id' => $this->leavetype_id,
            'date' => $this->date,
            'leave_save' => $this->leave_save,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchdepart($params)
    {
        $query = Leave::find()->where(['depart'=> Yii::$app->session["defaultdepid"] ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //จัดเรียงข้อมูลเริ่มต้น 
            'sort'=> ['defaultOrder' => ['leave_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'leave_id' => $this->leave_id,
            'userid' => $this->userid,
            'depart' => $this->depart,
            'leavetype_id' => $this->leavetype_id,
            'date' => $this->date,
            'leave_save' => $this->leave_save,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchdepartdate($date)
    {
        $query = Leave::find()->where(['depart'=> Yii::$app->session["defaultdepid"],'date' => $date]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //จัดเรียงข้อมูลเริ่มต้น 
            'sort'=> ['defaultOrder' => ['leave_id'=>SORT_DESC]]
        ]);

        $this->load($date);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'leave_id' => $this->leave_id,
            'userid' => $this->userid,
            'depart' => $this->depart,
            'leavetype_id' => $this->leavetype_id,
            'date' => $this->date,
            'leave_save' => $this->leave_save,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
