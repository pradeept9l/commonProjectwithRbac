<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_category`.
 */
class m180528_091541_create_tbl_branddetails_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_branddetails', [
            'id' => $this->primaryKey(),
            'name' => $this->string(500)->notNull(),
            'parent_id' => $this->integer()->null()->defaultValue(0),
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
        $this->dropTable('tbl_branddetails');
    }
}
