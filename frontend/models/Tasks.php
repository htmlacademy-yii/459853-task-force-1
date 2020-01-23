<?php

namespace app\models;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property string|null $attachment
 * @property string $location
 * @property int $price
 * @property string $end_date
 * @property int $user_create_id
 * @property int|null $user_employee_id
 * @property int $status_id
 * @property string|null $created_date
 *
 * @property Comments[] $comments
 * @property TaskResponse[] $taskResponses
 * @property Users $userEmployee
 * @property Users $userCreate
 * @property Category $category
 * @property Statuses $status
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'category_id', 'location', 'price', 'end_date', 'user_create_id', 'status_id'], 'required'],
            [['description'], 'string'],
            [['category_id', 'price', 'user_create_id', 'user_employee_id', 'status_id'], 'integer'],
            [['end_date', 'created_date'], 'safe'],
            [['title', 'location'], 'string', 'max' => 128],
            [['attachment'], 'string', 'max' => 255],
            [['user_employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_employee_id' => 'id']],
            [['user_create_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_create_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'attachment' => 'Attachment',
            'location' => 'Location',
            'price' => 'Price',
            'end_date' => 'End Date',
            'user_create_id' => 'User Create ID',
            'user_employee_id' => 'User Employee ID',
            'status_id' => 'Status ID',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskResponses()
    {
        return $this->hasMany(TaskResponse::className(), ['task_id' => 'id']);
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Statuses::className(), ['id' => 'status_id']);
    }
}
