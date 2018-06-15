<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_documents`.
 */
class m180608_062541_create_tbl_documents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_vehical_images', 'cat_id', $this->integer()->after('vehical_id')->null());
        $this->addColumn('tbl_vehical_images', 'attr_id', $this->integer()->after('cat_id')->null());
        $this->addColumn('tbl_vehical_images', 'file_icon', $this->string(200)->after('attr_id')->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
    }
}
