<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 */
class m191104_164306_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'reviews' => $this->text(),
            'user_id' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('reviews');
    }
}
