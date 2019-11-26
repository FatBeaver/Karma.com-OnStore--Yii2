<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_category}}`.
 */
class m191116_172841_create_blog_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('blog_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->defaultValue('Без названия'),
            'image' => $this->string(255),
            'description' => $this->string(255)->notNull()->defaultValue('Без описания'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('blog_category');
    }
}
