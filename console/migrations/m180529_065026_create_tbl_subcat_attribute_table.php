<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_subcat_attribute`.
 */
class m180529_065026_create_tbl_subcat_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_subcat_attribute', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'subcat_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-tbl_subcat_attribute-subcat_id',
            'tbl_subcat_attribute',
            'subcat_id'
        );
        // add foreign key for table `country_id`
        $this->addForeignKey(
            'fk-tbl_subcat_attribute-subcat_id',
            'tbl_subcat_attribute',
            'subcat_id',
            'tbl_subcategory',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_subcat_attribute');
    }
}
