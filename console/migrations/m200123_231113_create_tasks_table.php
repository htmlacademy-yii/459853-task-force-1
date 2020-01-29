<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m200123_231113_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'attachment' => $this->char(255),
            'location' => $this->string(),
            'price' => $this->money()->notNull(),
            'end_date' => $this->dateTime()->notNull(),
            'user_create_id' => $this->integer()->notNull(),
            'user_employee_id' => $this->integer(),
            'status_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // todo как добавить полнотекстовый индекс ?
//        $this->createIndex(
//            'title_descr',
//            'tasks',
//            'title, description'
//        );

        //CREATE FULLTEXT INDEX title_descr ON tasks(title, description);

        $this->addForeignKey(
            'fk_tasks_user_employee_id',
            'tasks',
            'user_employee_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_tasks_user_create_id',
            'tasks',
            'user_create_id',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_tasks_category_id',
            'tasks',
            'status_id',
            'statuses',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_tasks_status_id',
            'tasks',
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
        $this->dropTable('{{%tasks}}');
    }
}
