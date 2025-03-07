<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%MsBarang}}`.
 */
class m240918_144411_create_MsBarang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%MsBarang}}', [
            'MsBarang_id' => $this->primaryKey(),
            'MsBarang_nama' => $this->string(),
            'MsBarang_hargaBeli' => $this->decimal(19,0),
            'MsBarang_hargaJual' => $this->decimal(19,0),
            'MsBarang_stok' => $this->integer(),
            'MsBarang_kategori' => $this->string(),
            'MsBarang_keterangan' => $this->text(),
            'MsBarang_createdAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'MsBarang_createdBy' => $this->integer(),
            'MsBarang_updatedAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'MsBarang_updatedBy' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-MsBarang-createdBy',
            '{{%MsBarang}}',
            'MsBarang_createdBy',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-MsBarang-updatedBy',
            '{{%MsBarang}}',
            'MsBarang_updatedBy',
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
        $this->dropForeignKey('fk-MsBarang-createdBy', '{{%MsBarang}}');
        $this->dropForeignKey('fk-MsBarang-updatedBy', '{{%MsBarang}}');
        $this->dropTable('{{%MsBarang}}');
    }
}
