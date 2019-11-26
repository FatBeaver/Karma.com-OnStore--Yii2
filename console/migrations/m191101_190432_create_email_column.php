<?php

use yii\db\Migration;

/**
 * Class m191101_190432_create_email_column
 */
class m191101_190432_create_email_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('user', 'email', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('user', 'email');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191101_190432_create_email_column cannot be reverted.\n";

        return false;
    }
    */
}
