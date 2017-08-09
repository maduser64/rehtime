<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Userinfo;

/**
 * UserinfoSearch represents the model behind the search form about `app\models\Userinfo`.
 */
class UserinfoSearch extends Userinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'badgenumber', 'defaultdepid'], 'integer'],
            [['name'], 'safe'],
            [['name','title','beloag','cotton','address','position'], 'string', 'max' => 255],
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
        $query = Userinfo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'badgenumber' => $this->badgenumber,
            'defaultdepid' => $this->defaultdepid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchdepart($id)
    {
        $query = Userinfo::find()->where(['defaultdepid' => $id ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($id);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => $this->userid,
            'badgenumber' => $this->badgenumber,
            'defaultdepid' => $this->defaultdepid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

     /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchupdate($scandepart_id)
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


            $query = \app\models\Userinfo::find()
                    ->where(['defaultdepid' => $a]);

           
        }else{
            $query = \app\models\Userinfo::find()
                    ->where(['defaultdepid' => $scandepart_id]);
    }

        
        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($scandepart_id);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'userid' => $this->userid,
            'badgenumber' => $this->badgenumber,
            'defaultdepid' => $this->defaultdepid,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
