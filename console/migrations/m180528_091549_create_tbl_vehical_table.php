<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_vehical`.
 */
class m180528_091549_create_tbl_vehical_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_vehical', [
            'id' => $this->primaryKey(),
            'name' => $this->string(500)->notNull(),
            'brand_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'trim_id' => $this->integer()->null(),
            'color_id' => $this->integer()->notNull(),
            'fuel' => $this->integer()->notNull()->defaultValue(1)->comment('1 => Diesel, 2=> Petrol'),
            'year' => $this->integer(),
            'no_of_owner' => $this->integer()->null()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);
        
        $this->createIndex(
            'idx-tbl_vehical-brand_id',
            'tbl_vehical',
            'brand_id'
        );
        // add foreign key for table `country_id`
        $this->addForeignKey(
            'fk-tbl_vehical-brand_id',
            'tbl_vehical',
            'brand_id',
            'tbl_branddetails',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_vehical');
    }
}
