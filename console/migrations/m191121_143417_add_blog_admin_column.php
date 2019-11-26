<?php

use yii\db\Migration;

/**
 * Class m191121_143417_add_blog_admin_column
 */
class m191121_143417_add_blog_admin_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('user', 'blog_admin', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('user', 'blog_admin');
    }
}
