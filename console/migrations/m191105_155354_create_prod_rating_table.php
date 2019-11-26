<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prod_rating}}`.
 */
class m191105_155354_create_prod_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('prod_rating', [
            'id' => $this->primaryKey(),
            'stars' => $this->integer(1)->defaultValue(5),
            'product_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('prod_rating');
    }
}
