<?php

use yii\db\Migration;

/**
 * Class m191121_143423_add_admin_column
 */
class m191121_143423_add_admin_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('user', 'admin', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('user', 'admin');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191121_143423_add_admin_column cannot be reverted.\n";

        return false;
    }
    */
}
