<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_response".
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_employee_id
 * @property string|null $description
 * @property int $price
 * @property string|null $created_date
 *
 * @property Users $userEmployee
 * @property Tasks $task
 */
class TaskResponse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_response';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_employee_id', 'price'], 'required'],
            [['task_id', 'user_employee_id', 'price'], 'integer'],
            [['description'], 'string'],
            [['created_date'], 'safe'],
            [['user_employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_employee_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'user_employee_id' => 'User Employee ID',
            'description' => 'Description',
            'price' => 'Price',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserEmployee()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }
}
