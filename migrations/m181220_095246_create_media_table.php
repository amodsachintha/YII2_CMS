<?php

use yii\db\Migration;

/**
 * Handles the creation of table `media`.
 * Has foreign keys to the tables:
 *
 * - `document`
 */
class m181220_095246_create_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('media', [
            'id' => $this->primaryKey(),
            'document_id' => $this->integer()->notNull(),
            'url' => $this->string()->notNull(),
            'description' => $this->string(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci engine=InnoDB');

        // creates index for column `document_id`
        $this->createIndex(
            'idx-media-document_id',
            'media',
            'document_id'
        );

        // add foreign key for table `document`
        $this->addForeignKey(
            'fk-media-document_id',
            'media',
            'document_id',
            'document',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `document`
        $this->dropForeignKey(
            'fk-media-document_id',
            'media'
        );

        // drops index for column `document_id`
        $this->dropIndex(
            'idx-media-document_id',
            'media'
        );

        $this->dropTable('media');
    }
}
