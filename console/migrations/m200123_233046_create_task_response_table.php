<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_response}}`.
 */
class m200123_233046_create_task_response_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_response}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_employee_id' => $this->integer()->notNull(),
            'description' => $this->text(),
            'price' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

//        $this->addForeignKey(
//            'fk_comment_user_employee_id',
//            'task_response',
//            'user_employee_id',
//            'users',
//            'id',
//            'CASCADE'
//        );

        $this->addForeignKey(
            'fk_comment_user_task_id',
            'task_response',
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
        $this->dropTable('{{%task_response}}');
    }
}
