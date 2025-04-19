<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Club;

/**
 * ClubSearch represents the model behind the search form of `app\models\Club`.
 */
class ClubSearch extends Club
{
    public $showArchived;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return 
        [
            [['name'], 'string'],
            [['showArchived'], 'boolean'],
            [['name'], 'safe'],
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
        $query = Club::find();

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

        $query->andFilterWhere(['like', 'name', $this->name]);

        if (!$this->showArchived) {
            $query->andWhere(['deleted_at' => null]);
        }

        return $dataProvider;
    }
}
