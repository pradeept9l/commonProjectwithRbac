<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_weightage`.
 */
class m180608_062442_create_tbl_weightage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_weightage', [
            'id' => $this->primaryKey(),
            'v_id' => $this->integer()->notNull(),
            'cat_id' => $this->integer()->notNull(),
            'weightage' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_weightage');
    }
}
