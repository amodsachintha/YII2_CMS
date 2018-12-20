<?php

use yii\db\Migration;

/**
 * Handles the creation of table `api`.
 */
class m181220_095244_create_api_table extends Migration
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
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('api');
    }
}
