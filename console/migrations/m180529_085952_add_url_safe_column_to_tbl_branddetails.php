<?php

use yii\db\Migration;

/**
 * Class m180529_085952_add_url_safe_column_to_tbl_branddetails
 */
class m180529_085952_add_url_safe_column_to_tbl_branddetails extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_branddetails', 'url_safe', $this->string(255)->notNull()->after('name'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180529_085952_add_url_safe_column_to_tbl_branddetails cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180529_085952_add_url_safe_column_to_tbl_branddetails cannot be reverted.\n";

        return false;
    }
    */
}
