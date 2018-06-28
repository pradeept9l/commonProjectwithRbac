<?php

use yii\db\Migration;

/**
 * Handles adding price to table `tbl_vehical`.
 */
class m180627_093245_add_price_column_to_tbl_vehical_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->addColumn('tbl_vehical', 'price', $this->bigInteger()->null());
         $this->addColumn('tbl_vehical', 'mileage', $this->integer()->null());
         $this->addColumn('tbl_vehical', 'transmission', $this->tinyInteger()->notNull()->defaultValue(1));  
         $this->addColumn('tbl_vehical', 'body_type', $this->tinyInteger()->null());     
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
