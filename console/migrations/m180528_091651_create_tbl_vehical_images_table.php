<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_vehical_images`.
 */
class m180528_091651_create_tbl_vehical_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_vehical_images', [
            'id' => $this->primaryKey(),
            'imagename' => $this->text()->notNull(),
            'type' => $this->integer()->null()->defaultValue(1),
            'vehical_id' => $this->integer()->null()->defaultValue(0),
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
        $this->dropTable('tbl_vehical_images');
    }
}
