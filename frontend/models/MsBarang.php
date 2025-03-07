<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "msbarang".
 *
 * @property int $MsBarang_id
 * @property string|null $MsBarang_nama
 * @property float|null $MsBarang_hargaBeli
 * @property float|null $MsBarang_hargaJual
 * @property int|null $MsBarang_stok
 * @property string|null $MsBarang_kategori
 * @property string|null $MsBarang_keterangan
 * @property string|null $MsBarang_createdAt
 * @property int|null $MsBarang_createdBy
 * @property string|null $MsBarang_updatedAt
 * @property int|null $MsBarang_updatedBy
 *
 * @property User $msBarangCreatedBy
 * @property User $msBarangUpdatedBy
 * @property Trdetail[] $trdetails
 */
class MsBarang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'msbarang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MsBarang_hargaBeli', 'MsBarang_hargaJual'], 'number'],
            [['MsBarang_stok', 'MsBarang_createdBy', 'MsBarang_updatedBy'], 'integer'],
            [['MsBarang_keterangan'], 'string'],
            [['MsBarang_createdAt', 'MsBarang_updatedAt'], 'safe'],
            [['MsBarang_nama', 'MsBarang_hargaBeli', 'MsBarang_hargaJual', 'MsBarang_stok', 'MsBarang_kategori'], 'required'],
            [['MsBarang_nama', 'MsBarang_kategori'], 'string', 'max' => 255],
            [['MsBarang_createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['MsBarang_createdBy' => 'id']],
            [['MsBarang_updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['MsBarang_updatedBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MsBarang_id' => 'ID',
            'MsBarang_nama' => 'Nama Barang',
            'MsBarang_hargaBeli' => 'Harga Beli',
            'MsBarang_hargaJual' => 'Harga Jual',
            'MsBarang_stok' => 'Stok',
            'MsBarang_kategori' => 'Kategori',
            'MsBarang_keterangan' => 'Keterangan',
            'MsBarang_createdAt' => 'Created At',
            'MsBarang_createdBy' => 'Created By',
            'MsBarang_updatedAt' => 'Updated At',
            'MsBarang_updatedBy' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[MsBarangCreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsBarangCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'MsBarang_createdBy']);
    }

    /**
     * Gets query for [[MsBarangUpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsBarangUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'MsBarang_updatedBy']);
    }

    /**
     * Gets query for [[Trdetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrdetails()
    {
        return $this->hasMany(Trdetail::class, ['MsBarang_id' => 'MsBarang_id']);
    }

    public static function getAllBarang($TrHeader_tipe = null)
    {
        $data = self::find()->orderBy(['MsBarang_nama' => SORT_ASC, 'MsBarang_stok' => SORT_ASC])->all();
        if ($TrHeader_tipe == 'Penjualan')
        {
            $data = self::find()->where(['>', 'MsBarang_stok', 0])->orderBy('MsBarang_nama')->all();
        }
        $data = ArrayHelper::map($data, 'MsBarang_id', function($model) {
            return $model->MsBarang_nama . ' (' . $model->MsBarang_stok . ' Tersedia)';
        });
        return $data;
    }

    public static function getBarang($msBarang_id)
    {
        $data = self::find()->where(['MsBarang_id' => $msBarang_id])->one();
        return $data;
    }
}
