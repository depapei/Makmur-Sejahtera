<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%TrHeader}}`.
 */
class m240918_144431_create_TrHeader_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%TrHeader}}', [
            'TrHeader_id' => $this->primaryKey(),
            'MsCustomer_id' => $this->integer(),
            'TrHeader_tipe' => $this->string(),
            'TrHeader_judul' => $this->string(),
            'TrHeader_tanggal' => $this->date(),
            'TrHeader_nominal' => $this->decimal(19,0),
            'TrHeader_keterangan' => $this->text(),
            'TrHeader_createdIn' => $this->string(),
            'TrHeader_paymentMethod' => $this->string(),
            'TrHeader_paymentStatus' => $this->boolean(),
            'TrHeader_nama_dibuatOleh' => $this->string(),
            'TrHeader_nama_menyetujui' => $this->string(),
            'TrHeader_nama_pemeriksa' => $this->string(),
            'TrHeader_nama_pengirim' => $this->string(),
            'TrHeader_nama_penerima' => $this->string(),
            'TrHeader_filePath_dibuatOleh' => $this->string(),
            'TrHeader_filePath_menyetujui' => $this->string(),
            'TrHeader_filePath_pemeriksa' => $this->string(),
            'TrHeader_filePath_pengirim' => $this->string(),
            'TrHeader_filePath_penerima' => $this->string(),
            'TrHeader_createdAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'TrHeader_createdBy' => $this->integer(),
            'TrHeader_updatedAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'TrHeader_updatedBy' => $this->integer(),
        ]); 

        $this->addForeignKey(
            'fk-TrHeader-createdBy',
            '{{%TrHeader}}',
            'TrHeader_createdBy',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-TrHeader-updatedBy',
            '{{%TrHeader}}',
            'TrHeader_updatedBy',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-MsCustomer-id',
            '{{%TrHeader}}',
            'MsCustomer_id',
            '{{%MsCustomer}}',
            'MsCustomer_id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-TrHeader-createdBy', '{{%TrHeader}}');
        $this->dropForeignKey('fk-TrHeader-updatedBy', '{{%TrHeader}}');
        $this->dropForeignKey('fk-MsCustomer-id', '{{%TrHeader}}');
        $this->dropTable('{{%TrHeader}}');
    }
}
