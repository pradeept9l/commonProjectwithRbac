<?php

use yii\db\Migration;

/**
 * Class m180620_134548_add_fname_column_to_tbl_user
 */
class m180620_134548_add_fname_column_to_tbl_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'fname', $this->string()->after('username')->notNull());
        $this->addColumn('user', 'lname', $this->string()->after('fname')->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180620_134548_add_fname_column_to_tbl_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180620_134548_add_fname_column_to_tbl_user cannot be reverted.\n";

        return false;
    }
    */
}
