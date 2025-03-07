<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MsCustomer;

/**
 * MsCustomerSearch represents the model behind the search form of `app\models\MsCustomer`.
 */
class MsCustomerSearch extends MsCustomer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MsCustomer_id', 'MsCustomer_createdBy', 'MsCustomer_updatedBy'], 'integer'],
            [['MsCustomer_nama', 'MsCustomer_toko', 'MsCustomer_nomorHp', 'MsCustomer_email', 'MsCustomer_alamat', 'MsCustomer_createdAt', 'MsCustomer_updatedAt'], 'safe'],
            [['MsCustomer_hutang', 'MsCustomer_piutang'], 'number'],
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
        $query = MsCustomer::find();

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
            'MsCustomer_id' => $this->MsCustomer_id,
            'MsCustomer_hutang' => $this->MsCustomer_hutang,
            'MsCustomer_piutang' => $this->MsCustomer_piutang,
            'MsCustomer_createdAt' => $this->MsCustomer_createdAt,
            'MsCustomer_createdBy' => $this->MsCustomer_createdBy,
            'MsCustomer_updatedAt' => $this->MsCustomer_updatedAt,
            'MsCustomer_updatedBy' => $this->MsCustomer_updatedBy,
        ]);

        $query->andFilterWhere(['like', 'MsCustomer_nama', $this->MsCustomer_nama])
            ->andFilterWhere(['like', 'MsCustomer_toko', $this->MsCustomer_toko])
            ->andFilterWhere(['like', 'MsCustomer_nomorHp', $this->MsCustomer_nomorHp])
            ->andFilterWhere(['like', 'MsCustomer_email', $this->MsCustomer_email])
            ->andFilterWhere(['like', 'MsCustomer_alamat', $this->MsCustomer_alamat]);

        return $dataProvider;
    }
}
