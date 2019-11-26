<?php

use yii\db\Migration;

/**
 * Class m191019_150618_add_recommended_column_category
 */
class m191019_150618_add_recommended_column_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('category', 'recommended', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('category', 'recommended');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191019_150618_add_recommended_column_category cannot be reverted.\n";

        return false;
    }
    */
}
