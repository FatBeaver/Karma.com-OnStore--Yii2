<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prod_parametrs}}`.
 */
class m191015_202017_create_prod_parametrs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('prod_parametrs', [
            'id' => $this->primaryKey(),
            'width' => $this->string(50)->defaultValue(0),
            'height' => $this->string(50)->defaultValue(0),
            'depth' => $this->string(50)->defaultValue(0),
            'weight'=> $this->string(50)->defaultValue(0),
            'qual_check' => $this->string(50)->defaultValue(0),
            'freshness' => $this->string(50)->defaultValue(0),
            'packeting' => $this->string(50)->defaultValue(0),
            'box_contains' => $this->string(50)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('prod_parametrs');
    }
}
