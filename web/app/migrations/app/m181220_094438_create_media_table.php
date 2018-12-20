<?php

use yii\db\Migration;

/**
 * Handles the creation of table `media`.
 */
class m181220_094438_create_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('media', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'description' => $this->string(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('media');
    }
}
