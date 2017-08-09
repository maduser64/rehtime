<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Chkinout;

/**
 * ChkinoutSearch represents the model behind the search form about `app\models\Chkinout`.
 */
class ChkinoutSearch extends Chkinout
{
    public $userValues;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['userid'], 'required'],
            [['userid'], 'integer'],
            [['checktime', 'checktype','userid'], 'safe'],
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
        

        $query = Chkinout::find();


        // $sql = "SELECT u.badgenumber,SUBSTR(ch.checktime,1,11) AS date
        //         FROM scan_chkinout ch
        //         INNER JOIN scan_userinfo u
        //         ON ch.userid = u.badgenumber ";

        //         if($this->userid != ""){
        //             $sql .= " WHERE u.badgenumber = '$this->userid' ";
        //         }

        //         if($this->checktime != ""){
        //             $sql .= " AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN $this->checktime AND $this->checktime ";
        //         }

        // $query = Yii::$app->db->createCommand($sql)->queryAll();


        // add conditions that should always apply here

        //$query->joinWith(['userValues']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //จัดเรียงข้อมูลเริ่มต้น 
            'sort'=> ['defaultOrder' => [
                //'checktype'=>SORT_DESC,
                'checktime' => SORT_DESC
            ]]
        ]);

        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // SELECT u.badgenumber,SUBSTR(ch.checktime,1,11) AS date
        // FROM scan_chkinout ch
        // INNER JOIN scan_userinfo u
        // ON ch.userid = u.badgenumber
        // WHERE u.badgenumber ='2011'
        // AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN '2017-02-07' AND '2017-02-07';


        // grid filtering conditions
        $query->andFilterWhere([
          'userid' => $this->userid,
        //    'checktime' => $this->checktime,
        ]);

        //$query->andFilterWhere(['like','FROM_UNIXTIME(checktime, "%Y-%m-%d" )', $this->checktime]);

       

        $query->andFilterWhere(
                ['like','SUBSTR(checktime,1,11)', $this->checktime]);
                 //->andFilterWhere(['like', 'userid', $this->userid]);
        //          ->orFilterWhere(['like', 'checktime', $this->checktime]);

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
        

        $query = Chkinout::find();


        // $sql = "SELECT u.badgenumber,SUBSTR(ch.checktime,1,11) AS date
        //         FROM scan_chkinout ch
        //         INNER JOIN scan_userinfo u
        //         ON ch.userid = u.badgenumber ";

        //         if($this->userid != ""){
        //             $sql .= " WHERE u.badgenumber = '$this->userid' ";
        //         }

        //         if($this->checktime != ""){
        //             $sql .= " AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN $this->checktime AND $this->checktime ";
        //         }

        // $query = Yii::$app->db->createCommand($sql)->queryAll();


        // add conditions that should always apply here

        //$query->joinWith(['userValues']);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //จัดเรียงข้อมูลเริ่มต้น 
            'sort'=> ['defaultOrder' => [
                //'checktype'=>SORT_DESC,
                'checktime' => SORT_DESC
            ]]
        ]);

        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // SELECT u.badgenumber,SUBSTR(ch.checktime,1,11) AS date
        // FROM scan_chkinout ch
        // INNER JOIN scan_userinfo u
        // ON ch.userid = u.badgenumber
        // WHERE u.badgenumber ='2011'
        // AND DATE_FORMAT(ch.checktime,'%Y-%m-%d') BETWEEN '2017-02-07' AND '2017-02-07';


        // grid filtering conditions
        $query->andFilterWhere([
          'userid' => $this->userid,
        //    'checktime' => $this->checktime,
        ]);

        //$query->andFilterWhere(['like','FROM_UNIXTIME(checktime, "%Y-%m-%d" )', $this->checktime]);

       

        $query->andFilterWhere(
                ['like','SUBSTR(checktime,1,11)', $this->checktime]);
                 //->andFilterWhere(['like', 'userid', $this->userid]);
        //          ->orFilterWhere(['like', 'checktime', $this->checktime]);

        return $dataProvider;
    }
  

}
