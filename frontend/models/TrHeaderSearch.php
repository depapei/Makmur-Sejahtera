<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TrHeader;

/**
 * TrHeaderSearch represents the model behind the search form of `app\models\TrHeader`.
 */
class TrHeaderSearch extends TrHeader
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrHeader_id', 'MsCustomer_id', 'TrHeader_createdBy', 'TrHeader_updatedBy'], 'integer'],
            [['TrHeader_tipe', 'TrHeader_judul', 'TrHeader_tanggal', 'TrHeader_createdIn', 'TrHeader_nama_dibuatOleh', 'TrHeader_nama_menyetujui', 'TrHeader_nama_pemeriksa', 'TrHeader_nama_pengirim', 'TrHeader_nama_penerima', 'TrHeader_filePath_dibuatOleh', 'TrHeader_filePath_menyetujui', 'TrHeader_filePath_pemeriksa', 'TrHeader_filePath_pengirim', 'TrHeader_filePath_penerima', 'TrHeader_createdAt', 'TrHeader_updatedAt'], 'safe'],
            [['TrHeader_nominal'], 'number'],
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
        $query = TrHeader::find();

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
            'TrHeader_id' => $this->TrHeader_id,
            'MsCustomer_id' => $this->MsCustomer_id,
            'TrHeader_tanggal' => $this->TrHeader_tanggal,
            'TrHeader_nominal' => $this->TrHeader_nominal,
            'TrHeader_paymentStatus' => $this->TrHeader_paymentStatus,
            'TrHeader_createdAt' => $this->TrHeader_createdAt,
            'TrHeader_createdBy' => $this->TrHeader_createdBy,
            'TrHeader_updatedAt' => $this->TrHeader_updatedAt,
            'TrHeader_updatedBy' => $this->TrHeader_updatedBy,
        ]);

        $query->andFilterWhere(['like', 'TrHeader_tipe', $this->TrHeader_tipe])
            ->andFilterWhere(['like', 'TrHeader_judul', $this->TrHeader_judul])
            ->andFilterWhere(['like', 'TrHeader_createdIn', $this->TrHeader_createdIn])
            ->andFilterWhere(['like', 'TrHeader_nama_dibuatOleh', $this->TrHeader_nama_dibuatOleh])
            ->andFilterWhere(['like', 'TrHeader_nama_menyetujui', $this->TrHeader_nama_menyetujui])
            ->andFilterWhere(['like', 'TrHeader_nama_pemeriksa', $this->TrHeader_nama_pemeriksa])
            ->andFilterWhere(['like', 'TrHeader_nama_pengirim', $this->TrHeader_nama_pengirim])
            ->andFilterWhere(['like', 'TrHeader_nama_penerima', $this->TrHeader_nama_penerima])
            ->andFilterWhere(['like', 'TrHeader_paymentStatus]', $this->TrHeader_paymentStatus])
            ->andFilterWhere(['like', 'TrHeader_filePath_dibuatOleh', $this->TrHeader_filePath_dibuatOleh])
            ->andFilterWhere(['like', 'TrHeader_filePath_menyetujui', $this->TrHeader_filePath_menyetujui])
            ->andFilterWhere(['like', 'TrHeader_filePath_pemeriksa', $this->TrHeader_filePath_pemeriksa])
            ->andFilterWhere(['like', 'TrHeader_filePath_pengirim', $this->TrHeader_filePath_pengirim])
            ->andFilterWhere(['like', 'TrHeader_filePath_penerima', $this->TrHeader_filePath_penerima]);

        return $dataProvider;
    }
}
