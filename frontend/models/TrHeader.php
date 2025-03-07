<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "trheader".
 *
 * @property int $TrHeader_id
 * @property int|null $MsCustomer_id
 * @property string|null $TrHeader_tipe
 * @property string|null $TrHeader_judul
 * @property string|null $TrHeader_tanggal
 * @property float|null $TrHeader_nominal
 * @property string|null $TrHeader_keterangan 
 * @property string|null $TrHeader_createdIn
 * @property string|null $TrHeader_paymentMethod
 * @property string|null $TrHeader_paymentStatus
 * @property string|null $TrHeader_nama_dibuatOleh
 * @property string|null $TrHeader_nama_menyetujui
 * @property string|null $TrHeader_nama_pemeriksa
 * @property string|null $TrHeader_nama_pengirim
 * @property string|null $TrHeader_nama_penerima
 * @property string|null $TrHeader_filePath_dibuatOleh
 * @property string|null $TrHeader_filePath_menyetujui
 * @property string|null $TrHeader_filePath_pemeriksa
 * @property string|null $TrHeader_filePath_pengirim
 * @property string|null $TrHeader_filePath_penerima
 * @property string|null $TrHeader_createdAt
 * @property int|null $TrHeader_createdBy
 * @property string|null $TrHeader_updatedAt
 * @property int|null $TrHeader_updatedBy
 *
 * @property Mscustomer $msCustomer
 * @property User $trHeaderCreatedBy
 * @property User $trHeaderUpdatedBy
 * @property Trdetail[] $trdetails 
 */
class TrHeader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trheader';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MsCustomer_id', 'TrHeader_createdBy', 'TrHeader_updatedBy'], 'integer'],
            [['TrHeader_tanggal', 'TrHeader_createdAt', 'TrHeader_updatedAt'], 'safe'],
            [['MsCustomer_id', 'TrHeader_judul', 'TrHeader_tanggal', 'TrHeader_paymentStatus'], 'required'],
            [['TrHeader_nominal'], 'number'],
            [['TrHeader_keterangan'], 'string'], 
            [['TrHeader_tipe', 'TrHeader_judul', 'TrHeader_createdIn', 'TrHeader_nama_dibuatOleh', 'TrHeader_nama_menyetujui', 'TrHeader_nama_pemeriksa', 'TrHeader_nama_pengirim', 'TrHeader_nama_penerima', 'TrHeader_filePath_dibuatOleh', 'TrHeader_filePath_menyetujui', 'TrHeader_filePath_pemeriksa', 'TrHeader_filePath_pengirim', 'TrHeader_filePath_penerima', 'TrHeader_paymentMethod'], 'string', 'max' => 255],
            [['MsCustomer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mscustomer::class, 'targetAttribute' => ['MsCustomer_id' => 'MsCustomer_id']],
            [['TrHeader_createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['TrHeader_createdBy' => 'id']],
            [['TrHeader_updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['TrHeader_updatedBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TrHeader_id' => 'ID',
            'MsCustomer_id' => 'Nama Customer',
            'TrHeader_tipe' => 'Tipe Transaksi',
            'TrHeader_judul' => 'Judul',
            'TrHeader_tanggal' => 'Tanggal',
            'TrHeader_nominal' => 'Nominal',
            'TrHeader_createdIn' => 'Daerah Transaksi',
            'TrHeader_paymentMethod' => 'Metode Pembayaran',
            'TrHeader_paymentStatus' => 'Status Pembayaran',
            'TrHeader_keterangan' => 'Keterangan',
            'TrHeader_nama_dibuatOleh' => 'Nama Dibuat Oleh (Opsional)',
            'TrHeader_nama_menyetujui' => 'Nama Menyetujui (Opsional)',
            'TrHeader_nama_pemeriksa' => 'Nama Pemeriksa (Opsional)',
            'TrHeader_nama_pengirim' => 'Nama Pengirim (Opsional)',
            'TrHeader_nama_penerima' => 'Nama Penerima (Opsional)',
            'TrHeader_filePath_dibuatOleh' => 'Tanda Tangan Dibuat Oleh (Opsional)',
            'TrHeader_filePath_menyetujui' => 'Tanda Tangan Menyetujui (Opsional)',
            'TrHeader_filePath_pemeriksa' => 'Tanda Tangan Pemeriksa (Opsional)',
            'TrHeader_filePath_pengirim' => 'Tanda Tangan Pengirim (Opsional)',
            'TrHeader_filePath_penerima' => 'Tanda Tangan Penerima (Opsional)',
            'TrHeader_createdAt' => 'Dibuat Pada Tanggal',
            'TrHeader_createdBy' => 'Dibuat Oleh',
            'TrHeader_updatedAt' => 'Terakhir Diedit Pada Tanggal',
            'TrHeader_updatedBy' => 'Terakhir Diedit Oleh',
        ];
    }

    /**
     * Gets query for [[MsCustomer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsCustomer()
    {
        return $this->hasOne(Mscustomer::class, ['MsCustomer_id' => 'MsCustomer_id']);
    }

    /**
     * Gets query for [[TrHeaderCreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrHeaderCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'TrHeader_createdBy']);
    }

    /**
     * Gets query for [[TrHeaderUpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrHeaderUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'TrHeader_updatedBy']);
    }

    /** 
    * Gets query for [[Trdetails]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getTrDetails() 
    { 
        return $this->hasMany(TrDetail::class, ['TrHeader_id' => 'TrHeader_id']); 
    } 
}
