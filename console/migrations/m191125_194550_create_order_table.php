<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m191125_194550_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'res_price' => $this->string(50)->notNull(),
            'shipping' => $this->string(50)->notNull(),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'company' => $this->string(255),
            'phone' => $this->string(100)->notNull(),
            'email' => $this->string(255)->notNull(),
            'country' => $this->string(100)->notNull(),
            'region' => $this->string(200)->notNull(),
            'city' => $this->string(150)->notNull(),
            'first_addr' => $this->string(255)->notNull(),
            'second_addr' => $this->string(255),
            'status' => $this->integer(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
