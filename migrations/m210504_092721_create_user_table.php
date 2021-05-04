<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210504_092721_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string(512),
            'password_reset_token' => $this->string(512),
            'email' => $this->string(50)->unique(),
            'status' => $this->smallInteger(),
            'created_at' => $this->Integer()->notNull(),
            'updated_at' => $this->Integer()->notNull(),
            'verification_token' => $this->string(512),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
