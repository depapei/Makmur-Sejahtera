<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MsBarang;

/**
 * MsBarangSearch represents the model behind the search form of `app\models\MsBarang`.
 */
class MsBarangSearch extends MsBarang
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MsBarang_id', 'MsBarang_stok', 'MsBarang_createdBy', 'MsBarang_updatedBy'], 'integer'],
            [['MsBarang_nama', 'MsBarang_kategori', 'MsBarang_keterangan', 'MsBarang_createdAt', 'MsBarang_updatedAt'], 'safe'],
            [['MsBarang_hargaBeli', 'MsBarang_hargaJual'], 'number'],
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
        $query = MsBarang::find();

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
            'MsBarang_id' => $this->MsBarang_id,
            'MsBarang_hargaBeli' => $this->MsBarang_hargaBeli,
            'MsBarang_hargaJual' => $this->MsBarang_hargaJual,
            'MsBarang_stok' => $this->MsBarang_stok,
            'MsBarang_createdAt' => $this->MsBarang_createdAt,
            'MsBarang_createdBy' => $this->MsBarang_createdBy,
            'MsBarang_updatedAt' => $this->MsBarang_updatedAt,
            'MsBarang_updatedBy' => $this->MsBarang_updatedBy,
        ]);

        $query->andFilterWhere(['like', 'MsBarang_nama', $this->MsBarang_nama])
            ->andFilterWhere(['like', 'MsBarang_kategori', $this->MsBarang_kategori])
            ->andFilterWhere(['like', 'MsBarang_keterangan', $this->MsBarang_keterangan]);

        return $dataProvider;
    }
}
