<?php

namespace app\models;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "mscustomer".
 *
 * @property int $MsCustomer_id
 * @property string|null $MsCustomer_nama
 * @property string|null $MsCustomer_toko
 * @property float|null $MsCustomer_hutang
 * @property float|null $MsCustomer_piutang
 * @property string|null $MsCustomer_nomorHp
 * @property string|null $MsCustomer_email
 * @property string|null $MsCustomer_alamat
 * @property string|null $MsCustomer_createdAt
 * @property int|null $MsCustomer_createdBy
 * @property string|null $MsCustomer_updatedAt
 * @property int|null $MsCustomer_updatedBy
 *
 * @property User $msCustomerCreatedBy
 * @property User $msCustomerUpdatedBy
 * @property Trheader[] $trheaders
 */
class MsCustomer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mscustomer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MsCustomer_hutang', 'MsCustomer_piutang'], 'number'],
            [['MsCustomer_alamat'], 'string'],
            [['MsCustomer_nama'], 'required'],
            [['MsCustomer_createdAt', 'MsCustomer_updatedAt'], 'safe'],
            [['MsCustomer_createdBy', 'MsCustomer_updatedBy'], 'integer'],
            [['MsCustomer_nama', 'MsCustomer_toko', 'MsCustomer_email'], 'string', 'max' => 255],
            [['MsCustomer_nomorHp'], 'string', 'max' => 20],
            [['MsCustomer_createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['MsCustomer_createdBy' => 'id']],
            [['MsCustomer_updatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['MsCustomer_updatedBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MsCustomer_id' => 'ID',
            'MsCustomer_nama' => 'Nama Customer',
            'MsCustomer_toko' => 'Nama Toko Customer',
            'MsCustomer_hutang' => 'Hutang',
            'MsCustomer_piutang' => 'Piutang',
            'MsCustomer_nomorHp' => 'Nomor Hp',
            'MsCustomer_email' => 'Email',
            'MsCustomer_alamat' => 'Alamat',
            'MsCustomer_createdAt' => 'Created At',
            'MsCustomer_createdBy' => 'Created By',
            'MsCustomer_updatedAt' => 'Updated At',
            'MsCustomer_updatedBy' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[MsCustomerCreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsCustomerCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'MsCustomer_createdBy']);
    }

    /**
     * Gets query for [[MsCustomerUpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsCustomerUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'MsCustomer_updatedBy']);
    }

    /**
     * Gets query for [[Trheaders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrheaders()
    {
        return $this->hasMany(Trheader::class, ['MsCustomer_id' => 'MsCustomer_id']);
    }

    public static function getAllCustomer()
    {
        $data = self::find()->all();
        $data = ArrayHelper::map($data, 'MsCustomer_id', 'MsCustomer_nama');
        return $data;
    }

    public static function getCustomer($MsCustomer_id)
    {
        $data = self::find()->where(['MsCustomer_id' => $MsCustomer_id])->one();
        return $data;
    }
}
