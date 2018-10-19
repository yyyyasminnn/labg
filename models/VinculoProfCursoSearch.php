<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VinculoProfCurso;

/**
 * VinculoProfCursoSearch represents the model behind the search form of `app\models\VinculoProfCurso`.
 */
class VinculoProfCursoSearch extends VinculoProfCurso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'situacao_id', 'curso_id', 'prof_id', 'ativo'], 'integer'],
            [['created', 'updated'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = VinculoProfCurso::find();

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
            'id' => $this->id,
            'situacao_id' => $this->situacao_id,
            'curso_id' => $this->curso_id,
            'prof_id' => $this->prof_id,
            'created' => $this->created,
            'updated' => $this->updated,
            'ativo' => $this->ativo,
        ]);

        return $dataProvider;
    }
}
