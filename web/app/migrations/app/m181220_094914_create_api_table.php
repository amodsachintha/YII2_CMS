<?php

use yii\db\Migration;

/**
 * Handles the creation of table `api`.
 */
class m181220_094914_create_api_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('api', [
            'id' => $this->primaryKey(),
            'key' => $this->string()->notNull(),
            'hits' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('api');
    }
}
