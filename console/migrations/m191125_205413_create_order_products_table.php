<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_products}}`.
 */
class m191125_205413_create_order_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_products', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(11),
            'image' => $this->string(255),
            'name' => $this->string(255),
            'price' => $this->string(50),
            'qty' => $this->integer(11),
            'total_price' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_products');
    }
}
