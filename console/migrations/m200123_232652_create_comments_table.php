<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m200123_232652_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_create_id' => $this->integer()->notNull(),
            'user_employee_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'rating' => $this->float()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_comment_user_employee_id',
            'comments',
            'user_employee_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_comment_user_create_id',
            'comments',
            'user_create_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_comment_user_tasks_id',
            'comments',
            'task_id',
            'tasks',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}
