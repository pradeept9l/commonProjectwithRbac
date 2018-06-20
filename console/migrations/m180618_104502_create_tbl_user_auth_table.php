<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_user_auth`.
 */
class m180618_104502_create_tbl_user_auth_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_user_auth', [
            'id' => $this->primaryKey(),
            'user_id'   => $this->integer()->notNull(),
            'auth_key'  => $this->text()->notNull(),
            'created_at'=> $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull(),
            'status'    => $this->tinyInteger(4)->defaultValue('1')->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tbl_user_auth');
    }
}
