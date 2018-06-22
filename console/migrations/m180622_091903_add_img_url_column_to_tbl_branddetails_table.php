<?php

use yii\db\Migration;

/**
 * Handles adding img_url to table `tbl_branddetails`.
 */
class m180622_091903_add_img_url_column_to_tbl_branddetails_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->addColumn('tbl_branddetails', 'img_url', $this->string(200)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
