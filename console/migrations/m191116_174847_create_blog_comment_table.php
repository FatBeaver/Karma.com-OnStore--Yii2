<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_comment}}`.
 */
class m191116_174847_create_blog_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog_comment', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'user_id' => $this->integer(11),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
            'blog_id' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_comment');
    }
}
