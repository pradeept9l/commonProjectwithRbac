<?php

use yii\db\Migration;

/**
 * Handles adding type to table `tbl_subcat_attribute`.
 */
class m180530_125701_add_type_column_to_tbl_subcat_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_subcat_attribute', 'type', $this->tinyInteger()->after('subcat_id')->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbl_subcat_attribute', 'type');
    }
}
