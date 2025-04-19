<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_club}}`.
 */
class m250418_145524_create_client_club_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Создаём связующую таблицу для "доступных клубов"
        $this->createTable('{{%client_club}}', [
            'client_id' => $this->integer()->notNull(),
            'club_id' => $this->integer()->notNull(),
            'PRIMARY KEY(client_id, club_id)',
        ]);
        $this->addForeignKey('fk-client_club-client', '{{%client_club}}', 'client_id', '{{%client}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-client_club-club', '{{%client_club}}', 'club_id', '{{%club}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client_club}}');
    }
}
