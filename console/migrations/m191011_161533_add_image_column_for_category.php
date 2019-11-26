<?php

use yii\db\Migration;

/**
 * Class m191011_161533_add_image_column_for_category
 */
class m191011_161533_add_image_column_for_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('category', 'image', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('category', 'image');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191011_161533_add_image_column_for_category cannot be reverted.\n";

        return false;
    }
    */
}
