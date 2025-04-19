<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%club}}`.
 */
class m250418_144205_create_club_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%club}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->text(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
        ]);

        $this->addForeignKey('fk-club-created_by', '{{%club}}', 'created_by', '{{%user}}', 'id');
        $this->addForeignKey('fk-club-updated_by', '{{%club}}', 'updated_by', '{{%user}}', 'id');
        $this->addForeignKey('fk-club-deleted_by', '{{%club}}', 'deleted_by', '{{%user}}', 'id');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%club}}');
    }
}
