<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_post}}`.
 */
class m191116_172825_create_blog_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('blog_post', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->defaultValue('Без названия'),
            'user_id' => $this->integer(11),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
            'image' => $this->string(255),
            'light_descr' => $this->string(255)->notNull()->defaultValue('Нет краткого описания...'),
            'content' => $this->text(),
            'viewed' => $this->integer(11)->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('blog_post');
    }
}
