<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form of `app\models\Client`.
 */
class ClientSearch extends Client
{
    public $start_date; 
    public $end_date;   

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name'], 'string'],
            [['gender'], 'in', 'range' => ['Male', 'Female']], 
            [['start_date', 'end_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Client::find()
        ->where(['client.deleted_at' => null])
        ->joinWith('clubs')
        ->groupBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'gender', $this->gender]);

        if (!empty($this->start_date)) {
            $query->andFilterWhere(['>=', 'birth_date', $this->start_date]);
        }
            
        if (!empty($this->end_date)) {
            $query->andFilterWhere(['<=', 'birth_date', $this->end_date]);
        }

        return $dataProvider;
    }
}
