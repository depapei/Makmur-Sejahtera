<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%MsCustomer}}`.
 */
class m240918_144400_create_MsCustomer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%MsCustomer}}', [
            'MsCustomer_id' => $this->primaryKey(),
            'MsCustomer_nama' => $this->string(),
            'MsCustomer_toko' => $this->string(),
            'MsCustomer_hutang' => $this->decimal(19,0),
            'MsCustomer_piutang' => $this->decimal(19,0),
            'MsCustomer_nomorHp' => $this->string(20),
            'MsCustomer_email' => $this->string(),
            'MsCustomer_alamat' => $this->text(),
            'MsCustomer_createdAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'MsCustomer_createdBy' => $this->integer(),
            'MsCustomer_updatedAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'MsCustomer_updatedBy' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-MsCustomer-createdBy',
            '{{%MsCustomer}}',
            'MsCustomer_createdBy',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-MsCustomer-updatedBy',
            '{{%MsCustomer}}',
            'MsCustomer_updatedBy',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-MsCustomer-createdBy', '{{%MsCustomer}}');
        $this->dropForeignKey('fk-MsCustomer-updatedBy', '{{%MsCustomer}}');
        $this->dropTable('{{%MsCustomer}}');
    }
}
