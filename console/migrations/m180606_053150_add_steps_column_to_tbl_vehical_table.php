<?php

use yii\db\Migration;

/**
 * Handles adding steps to table `tbl_vehical`.
 */
class m180606_053150_add_steps_column_to_tbl_vehical_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_vehical', 'steps', $this->tinyInteger()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
