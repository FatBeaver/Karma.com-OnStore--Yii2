<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m191011_142607_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'light_descr' => $this->string(255),
            'full_descr' => $this->string(255),
            'images' => $this->text(),
            'price' => $this->float()->defaultValue(0),
            'availibility' => $this->integer(1)->notNull()->defaultValue(1),
            'category_id' => $this->integer(11),
            'brand' => $this->string(255),
            'parametrs_id' => $this->integer(11),
            'stars' => $this->float(),
            'recommended' => $this->integer(1)->notNull()->defaultValue(0),
            'sale' => $this->integer(1)->notNull()->defaultValue(0),
            'deals_week' => $this->integer(1)->notNull()->defaultValue(0),
            'exclusive' => $this->integer(1)->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
