<?php

use yii\db\Migration;

class m250417_165741_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250417_165741_create_admin_user cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('admin123'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }
    
    public function down()
    {
        $this->delete('{{%user}}', ['username' => 'admin']);
    }
}
