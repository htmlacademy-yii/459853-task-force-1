<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200123_225433_create_users_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(255)->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
            'description' => $this->text(),
            'location' => $this->char(128)->notNull(),
            'password' => $this->string()->notNull(),
            'avatar' => $this->char(128),
            'birth_date' => $this->date(),
            'phone' => $this->string(),
            'social' => $this->string(),
            'category_id' => $this->char(128),
            'show_contacts' => $this->tinyInteger()->defaultValue(0),
            'notification_email' => $this->tinyInteger()->defaultValue(1),
            'notification_action' => $this->tinyInteger()->defaultValue(1),
            'notification_review' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
