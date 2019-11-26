<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_data}}`.
 */
class m191109_140804_create_user_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('user_data', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'first_name' => $this->string(150),
            'last_name' => $this->string(150),
            'company' => $this->string(150),
            'number_phone' => $this->string(100),
            'first_address' => $this->string(255),
            'second_address' => $this->string(255),
            'country' => $this->string(255),
            'region' => $this->string(255),
            'city' => $this->string(255),
            'image' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('user_data');
    }
}
