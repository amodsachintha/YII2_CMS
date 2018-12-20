<?php

use yii\db\Migration;

/**
 * Handles the creation of table `document`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `category`
 */
class m181220_094915_create_document_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('document', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-document-user_id',
            'document',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-document-user_id',
            'document',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-document-category_id',
            'document',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-document-category_id',
            'document',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-document-user_id',
            'document'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-document-user_id',
            'document'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-document-category_id',
            'document'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-document-category_id',
            'document'
        );

        $this->dropTable('document');
    }
}
