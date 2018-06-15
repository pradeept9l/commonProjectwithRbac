<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_attribute_value`.
 */
class m180530_055446_create_tbl_attribute_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_attribute_value', [
            'id' => $this->primaryKey(),
            'v_id' => $this->integer()->notNull(),
            'cat_id' => $this->integer()->notNull(),
            'subcat_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'answer' => $this->tinyInteger()->notNull()->defaultValue(0)->comment('1=> Yes, 0=> NO'),
            'comments' => $this->string(500)->null(),
            'repair_Cost' => $this->integer()->null()->defaultValue(0),
            'score' => $this->string(500)->null(),
            'ifissue' => $this->string(500)->null(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
        ]);
        $this->createIndex(
            'idx-tbl_attribute_value-v_id',
            'tbl_attribute_value',
            'v_id'
        );
        // add foreign key for table `country_id`
        $this->addForeignKey(
            'fk-tbl_attribute_value-v_id',
            'tbl_attribute_value',
            'v_id',
            'tbl_vehical',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-tbl_attribute_value-cat_id',
            'tbl_attribute_value',
            'cat_id'
        );
        // add foreign key for table `country_id`
        $this->addForeignKey(
            'fk-tbl_attribute_value-cat_id',
            'tbl_attribute_value',
            'cat_id',
            'tbl_category',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-tbl_attribute_value-subcat_id',
            'tbl_attribute_value',
            'subcat_id'
        );
        // add foreign key for table `country_id`
        $this->addForeignKey(
            'fk-tbl_attribute_value-subcat_id',
            'tbl_attribute_value',
            'subcat_id',
            'tbl_subcategory',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            'idx-tbl_attribute_value-attribute_id',
            'tbl_attribute_value',
            'attribute_id'
        );
        // add foreign key for table `country_id`
        $this->addForeignKey(
            'fk-tbl_attribute_value-attribute_id',
            'tbl_attribute_value',
            'attribute_id',
            'tbl_subcat_attribute',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_attribute_value');
    }
}
