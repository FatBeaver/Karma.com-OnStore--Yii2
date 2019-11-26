<?php

use yii\db\Migration;

/**
 * Class m191119_163519_add_status_blog_comment_table
 */
class m191119_163519_add_status_blog_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('blog_comment', 'status', $this->integer(1)->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('blog_comment', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191119_163519_add_status_blog_comment_table cannot be reverted.\n";

        return false;
    }
    */
}
