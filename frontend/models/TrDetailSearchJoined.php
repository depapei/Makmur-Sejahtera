<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TrDetail;

/**
 * TrDetailSearch represents the model behind the search form of `app\models\TrDetail`.
 */
class TrDetailSearchJoined extends TrDetail
{
    public $MsCustomer_id;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrDetail_id', 'TrHeader_id', 'MsBarang_id', 'TrDetail_createdBy', 'TrDetail_updatedBy'], 'integer'],
            [['TrDetail_qty', 'TrDetail_jumlahHarga', 'TrDetail_diskon'], 'number'],
            [['TrDetail_createdAt', 'TrDetail_updatedAt'], 'safe'],
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
        $query = TrDetail::find()->joinWith('trHeader');

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
            'TrDetail_id' => $this->TrDetail_id,
            'TrHeader_id' => $this->TrHeader_id,
            'MsBarang_id' => $this->MsBarang_id,
            'TrDetail_qty' => $this->TrDetail_qty,
            'TrDetail_jumlahHarga' => $this->TrDetail_jumlahHarga,
            'TrDetail_diskon' => $this->TrDetail_diskon,
            'TrDetail_createdAt' => $this->TrDetail_createdAt,
            'TrDetail_createdBy' => $this->TrDetail_createdBy,
            'TrDetail_updatedAt' => $this->TrDetail_updatedAt,
            'TrDetail_updatedBy' => $this->TrDetail_updatedBy,
            'trHeader.MsCustomer_id' => $this->MsCustomer_id,
        ]);

        return $dataProvider;
    }
}
