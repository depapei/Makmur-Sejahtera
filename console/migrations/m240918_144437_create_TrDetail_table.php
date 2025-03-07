<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%TrDetail}}`.
 */
class m240918_144437_create_TrDetail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%TrDetail}}', [
            'TrDetail_id' => $this->primaryKey(),
            'TrHeader_id' => $this->integer(),
            'MsBarang_id' => $this->integer(),
            'TrDetail_qty' => $this->decimal(19, 0),
            'TrDetail_jumlahHarga' => $this->decimal(19, 0),
            'TrDetail_diskon' => $this->decimal(19,0),
            'TrDetail_createdAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'TrDetail_createdBy' => $this->integer(),
            'TrDetail_updatedAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'TrDetail_updatedBy' => $this->integer(),
            'TrDetail_keterangan' => $this->text(),
        ]);

        $this->addForeignKey(
            'fk-TrDetail-createdBy',
            '{{%TrDetail}}',
            'TrDetail_createdBy',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-TrDetail-updatedBy',
            '{{%TrDetail}}',
            'TrDetail_updatedBy',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-MsBarang-id',
            '{{%TrDetail}}',
            'MsBarang_id',
            '{{%MsBarang}}',
            'MsBarang_id',
            'CASCADE',
            'CASCADE',
        );

        $this->addForeignKey(
            'fk-TrHeader-id',
            '{{%TrDetail}}',
            'TrHeader_id',
            '{{%TrHeader}}',
            'TrHeader_id',
            'CASCADE',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-TrDetail-createdBy', '{{%TrDetail}}');
        $this->dropForeignKey('fk-TrDetail-updatedBy', '{{%TrDetail}}');
        $this->dropForeignKey('fk-MsBarang-id', '{{%TrDetail}}');
        $this->dropForeignKey('fk-TrHeader-id', '{{%TrDetail}}');
        $this->dropTable('{{%TrDetail}}');
    }
}
