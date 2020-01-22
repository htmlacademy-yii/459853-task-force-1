<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $task_id
 * @property int $user_create_id
 * @property int $user_employee_id
 * @property string|null $description
 * @property int $rating
 *
 * @property Users $userEmployee
 * @property Users $userCreate
 * @property Tasks $task
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_create_id', 'user_employee_id', 'rating'], 'required'],
            [['task_id', 'user_create_id', 'user_employee_id', 'rating'], 'integer'],
            [['description'], 'string'],
            [['user_employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_employee_id' => 'id']],
            [['user_create_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_create_id' => 'id']],
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
            'user_create_id' => 'User Create ID',
            'user_employee_id' => 'User Employee ID',
            'description' => 'Description',
            'rating' => 'Rating',
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
    public function getUserCreate()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_create_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }
}
