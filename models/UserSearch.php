<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User {

    public $memberValues;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['title','username', 'password', 'firstname', 'surname','nickname', 'position_name', 'depart_id', 'memberValues', 'code', 'email', 'tel'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['memberValues']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['memberValues'] = [
            'asc' => ['sso_depart.name' => SORT_ASC],
            'desc' => ['sso_depart.name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'created_date' => $this->created_date,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'username', $this->username])                
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'firstname', $this->firstname])
                ->andFilterWhere(['like', 'surname', $this->surname])
                ->andFilterWhere(['like', 'nickname', $this->nickname])
                ->andFilterWhere(['like', 'position_name', $this->position_name])
                ->andFilterWhere(['like', 'depart_id', $this->depart_id])                
                ->andFilterWhere(['like', 'code', $this->code])                
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'tel', $this->tel])                
                ->andFilterWhere(['like', 'sso_depart.name', $this->memberValues]);

        return $dataProvider;
    }

}
