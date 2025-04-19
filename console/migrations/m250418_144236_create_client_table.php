<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m250418_144236_create_client_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()->notNull(),
            'gender' => "ENUM('male', 'female') NOT NULL",
            'birth_date' => $this->date(),

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'deleted_at' => $this->integer(),
            'deleted_by' => $this->integer(),
        ]);

        $this->addForeignKey('fk-client-created_by', '{{%client}}', 'created_by', '{{%user}}', 'id');
        $this->addForeignKey('fk-client-updated_by', '{{%client}}', 'updated_by', '{{%user}}', 'id');
        $this->addForeignKey('fk-client-deleted_by', '{{%client}}', 'deleted_by', '{{%user}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%client}}');
    }
}
