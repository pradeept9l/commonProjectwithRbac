<?php

use yii\db\Migration;

/**
 * Class m180529_065212_insert_category
 */
class m180529_065212_insert_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('tbl_category',array(
            'name' => 'Vehical Documents/History',
            'weightage' => '0',
            'created_at' => time(),
            'updated_at' => time(),
            'status'    =>  1,
        ));
        $this->insert('tbl_category',array(
            'name' => 'Test Drive/Road Test',
            'weightage' => '25',
            'created_at' => time(),
            'updated_at' => time(),
            'status'    =>  1,
        ));
        $this->insert('tbl_category',array(
            'name' => 'Vehicle Body (function and Exterior condition)',
            'weightage' => '25',
            'created_at' => time(),
            'updated_at' => time(),
            'status'    =>  1,
        ));
        $this->insert('tbl_category',array(
            'name' => 'Under the Bonnet',
            'weightage' => '25',
            'created_at' => time(),
            'updated_at' => time(),
            'status'    =>  1,
        ));
        $this->insert('tbl_category',array(
            'name' => 'TIRES AND WHEELS',
            'weightage' => '5',
            'created_at' => time(),
            'updated_at' => time(),
            'status'    =>  1,
        ));
        $this->insert('tbl_category',array(
            'name' => 'INTERIOR AMENITIES',
            'weightage' => '20',
            'created_at' => time(),
            'updated_at' => time(),
            'status'    =>  1,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180529_065212_insert_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180529_065212_insert_category cannot be reverted.\n";

        return false;
    }
    */
}
