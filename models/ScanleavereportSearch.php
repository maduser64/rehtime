<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Scanleavereport;

/**
 * ScanleavereportSearch represents the model behind the search form about `app\models\Scanleavereport`.
 */
class ScanleavereportSearch extends Scanleavereport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leave_id', 'userid', 'depart', 'leavetype_id', 'status'], 'integer'],
            [['date', 'date_end', 'leave_save', 'commend', 'commend1', 'leave_beloag', 'leave_cotton', 'leave_address', 'leave_ass', 'leave_position'], 'safe'],
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
        
        
       
        $name = Yii::$app->session["fname"];
        $fname = Yii::$app->session["lname"];

        $sql = "SELECT badgenumber,`name`,defaultdepid
                FROM scan_userinfo
                WHERE `name` LIKE '%$name%' AND `name` LIKE '%$fname%';";


            $dataReader = Yii::$app->db->createCommand($sql)->query();

            foreach ($dataReader as $r) {
                Yii::$app->session["defaultdepid"] = $r['defaultdepid'];
                $user = $r['badgenumber'];


            }

            $scandepart_id = Yii::$app->session["defaultdepid"];



        $sql1 = "SELECT depart_id
                FROM scan_service AS s
                INNER JOIN scan_userinfo AS u ON s.user_id = u.badgenumber
                WHERE s.user_id = '$user'; ";

        $data1 = Yii::$app->db->createCommand($sql1)->query();

        $coutdepart = count($data1);

                    
        $i = 0;
        $a = array();
        $depart = "";
        $depart1 = "";

       

        if($coutdepart > 1){
            foreach ($data1 as $r) {
                $a[$i] = $r['depart_id'];
                $i++;
            }

        //$data = \app\models\Department::find()->where(['deptid' => $a])->all();
            $query = Scanleavereport::find()->where(['depart'=> $a]);
        }else{
        //$data = \app\models\Department::find()->where(['deptid' => Yii::$app->session["defaultdepid"]])->all();

            $query = Scanleavereport::find()->where(['depart'=> $scandepart_id]);
        }


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
            'userid' => $this->userid,
            //'depart' => $this->depart,
        ]);


        return $dataProvider;
    }


    public function searchadmin($params)
    {

        $query = Scanleavereport::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //จัดเรียงข้อมูลเริ่มต้น 
            'sort'=> ['defaultOrder' => ['leavetype_id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => $this->userid,
            'depart' => $this->depart,
        ]);

        //$query->andFilterWhere(['like', 'depart', $this->depart]);

        return $dataProvider;
    }




    
}
