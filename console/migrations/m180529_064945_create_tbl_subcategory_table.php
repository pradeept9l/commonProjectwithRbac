<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_subcategory`.
 */
class m180529_064945_create_tbl_subcategory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_subcategory', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'cat_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-tbl_subcategory-cat_id',
            'tbl_subcategory',
            'cat_id'
        );
        // add foreign key for table `country_id`
        $this->addForeignKey(
            'fk-tbl_subcategory-cat_id',
            'tbl_subcategory',
            'cat_id',
            'tbl_category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_subcategory');
    }
}
