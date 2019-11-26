<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_category_links}}`.
 */
class m191116_173821_create_blog_category_links_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('blog_category_links', [
            'id' => $this->primaryKey(),
            'blog_id' => $this->integer(11),
            'category_id' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('blog_category_links');
    }
}
