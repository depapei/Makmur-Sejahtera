<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "trdetail".
 *
 * @property int $TrDetail_id
 * @property int|null $TrHeader_id
 * @property int|null $MsBarang_id
 * @property float|null $TrDetail_qty
 * @property float|null $TrDetail_jumlahHarga
 * @property float|null $TrDetail_diskon
 * @property string|null $TrDetail_createdAt
 * @property int|null $TrDetail_createdBy
 * @property string|null $TrDetail_updatedAt
 * @property int|null $TrDetail_updatedBy
 * @property string|null $TrDetail_keterangan
 *
 * @property Msbarang $msBarang
 * @property User $trDetailCreatedBy
 * @property User $trDetailUpdatedBy
 * @property Trheader $trHeader
 */
class TrDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trdetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TrHeader_id', 'MsBarang_id', 'TrDetail_createdBy', 'TrDetail_updatedBy'], 'integer'],
            [['TrDetail_qty', 'TrDetail_jumlahHarga', 'TrDetail_diskon'], 'number'],
            [['TrDetail_qty', 'MsBarang_id'], 'required'],
            [['TrDetail_createdAt', 'TrDetail_updatedAt', 'TrDetail_keterangan'], 'safe'],
            [['MsBarang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Msbarang::class, 'targetAttribute' => ['MsBarang_id' => 'MsBarang_id']],
            [['TrDetail_createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['TrDetail_createdBy' => 'id']],
            [['TrDetail_updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['TrDetail_updatedBy' => 'id']],
            [['TrHeader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trheader::class, 'targetAttribute' => ['TrHeader_id' => 'TrHeader_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrDetail_id' => 'ID',
            'TrHeader_id' => 'Transaksi ID',
            'MsBarang_id' => 'Barang',
            'TrDetail_qty' => 'Jumlah Barang',
            'TrDetail_jumlahHarga' => 'Jumlah Harga',
            'TrDetail_diskon' => 'Diskon (%)',
            'TrDetail_createdAt' => 'Dibuat Pada Tanggal',
            'TrDetail_createdBy' => 'Dibuat Oleh',
            'TrDetail_updatedAt' => 'Terakhir Diedit Pada Tanggal',
            'TrDetail_updatedBy' => 'Terakhir Diedit Oleh',
            'TrDetail_keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[MsBarang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsBarang()
    {
        return $this->hasOne(Msbarang::class, ['MsBarang_id' => 'MsBarang_id']);
    }

    /**
     * Gets query for [[TrDetailCreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrDetailCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'TrDetail_createdBy']);
    }

    /**
     * Gets query for [[TrDetailUpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrDetailUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'TrDetail_updatedBy']);
    }

    /**
     * Gets query for [[TrHeader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrHeader()
    {
        return $this->hasOne(Trheader::class, ['TrHeader_id' => 'TrHeader_id']);
    }

    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'TrDetail_id', 'TrDetail_id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['TrDetail_id']) && !empty($item['TrDetail_id']) && isset($multipleModels[$item['TrDetail_id']])) {
                    $models[] = $multipleModels[$item['TrDetail_id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }
        unset($model, $formName, $post);
        return $models;
    }

    public static function manipulateTransactions($model)
    {
        $trDetail_model = $model;
        $valid = false;
        // Memanipulasi Stok
        $barang = MsBarang::getBarang($trDetail_model->MsBarang_id);
        if ($trDetail_model->trHeader->TrHeader_tipe === 'Penjualan')
        {
            $harga = $barang->MsBarang_hargaJual;
            if ($trDetail_model->msBarang->MsBarang_stok < $trDetail_model->TrDetail_qty || $barang->MsBarang_stok === 0){
                Yii::$app->session->setFlash('error', 'Stok tidak mencukupi! <strong>"'.$trDetail_model->msBarang->MsBarang_nama.'"</strong> Stok yang tersedia = '.$trDetail_model->msBarang->MsBarang_stok);
                $trDetail_model->Keterangan = 'Stok tidak mencukupi!' . "\n<strong>".$trDetail_model->msBarang->MsBarang_nama."</strong> Stok yang tersedia = ".$trDetail_model->msBarang->MsBarang_stok;
            } else {
                $barang->MsBarang_stok = $barang->MsBarang_stok - $trDetail_model->TrDetail_qty;
            }
        } 
        else if ($trDetail_model->trHeader->TrHeader_tipe === 'Pembelian')
        {
            $harga = $barang->MsBarang_hargaBeli;
            $barang->MsBarang_stok = $barang->MsBarang_stok + $trDetail_model->TrDetail_qty;
        }

        // Mengatur Diskon
        if ($trDetail_model->TrDetail_diskon)
        {
            $diskon = $trDetail_model->TrDetail_diskon / 100;
            $trDetail_model->TrDetail_jumlahHarga = $harga - $diskon * $harga;
            $trDetail_model->TrDetail_jumlahHarga = $trDetail_model->TrDetail_jumlahHarga * $trDetail_model->TrDetail_qty;

        }
        else {
            $trDetail_model->TrDetail_diskon = 0;
            $trDetail_model->TrDetail_jumlahHarga = $trDetail_model->TrDetail_qty * $harga;
        }

        if ($barang->save()){
            return $model;
        }
    }

    /**
     * Mengatur Hutang / Piutang
     * Jika transaksi penjualan dan belum dibayar maka hutang pelanggan akan bertambah
     * Jika transaksi pembelian dan belum dibayar maka piutang pelanggan akan bertambah
     * @param TrDetail $trDetailModel Model yang berisi data transaksi
     * @param int $MsCustomer_id ID pelanggan
     */
    public static function manipulateHutang($details, $MsCustomer_id){
        // Mengatur Hutang / Piutang
        $customer = MsCustomer::getCustomer($MsCustomer_id);
        $tipe = '';
        $total = 0;
        foreach ($details as $trDetail_model)
        {
            if (!$trDetail_model->trHeader->TrHeader_paymentStatus)
            {
                $total += $trDetail_model->TrDetail_jumlahHarga;
            }
        }
        if ($tipe === 'Penjualan')
        {
            $customer->MsCustomer_hutang = $customer->MsCustomer_hutang + $total;
        }
        else if ($tipe === 'Pembelian')
        {
            $customer->MsCustomer_piutang = $customer->MsCustomer_piutang + $total;
        }
        $customer->save();
    }
}
