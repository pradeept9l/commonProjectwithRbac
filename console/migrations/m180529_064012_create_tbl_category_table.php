<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_category`.
 */
class m180529_064012_create_tbl_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),            
            'weightage' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_category');
    }
}
