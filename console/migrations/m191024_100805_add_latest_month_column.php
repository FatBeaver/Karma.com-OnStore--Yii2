<?php

use yii\db\Migration;

/**
 * Class m191024_100805_add_latest_month_column
 */
class m191024_100805_add_latest_month_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('product', 'latest', $this->integer(1)->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('product', 'latest');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191024_100805_add_latest_month_column cannot be reverted.\n";

        return false;
    }
    */
}
