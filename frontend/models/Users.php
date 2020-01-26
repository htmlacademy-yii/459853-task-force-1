<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $lastname
 * @property string|null $description
 * @property string $location
 * @property string $password
 * @property string|null $avatar
 * @property string|null $birth_date
 * @property string|null $phone
 * @property string|null $social
 * @property string|null $category_id
 * @property int|null $show_contacts
 * @property int|null $notification_email
 * @property int|null $notification_action
 * @property int|null $notification_review
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Comments[] $comments
 * @property Comments[] $comments0
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'name', 'lastname', 'location', 'password'], 'required'],
            [['description'], 'string'],
            [['birth_date', 'created_at', 'updated_at'], 'safe'],
            [['show_contacts', 'notification_email', 'notification_action', 'notification_review'], 'integer'],
            [['email', 'name', 'lastname', 'password', 'phone', 'social'], 'string', 'max' => 255],
            [['location', 'avatar'], 'string', 'max' => 128],
            [['category_id'], 'string', 'max' => 1],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'Name',
            'lastname' => 'Lastname',
            'description' => 'Description',
            'location' => 'Location',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'birth_date' => 'Birth Date',
            'phone' => 'Phone',
            'social' => 'Social',
            'category_id' => 'Category ID',
            'show_contacts' => 'Show Contacts',
            'notification_email' => 'Notification Email',
            'notification_action' => 'Notification Action',
            'notification_review' => 'Notification Review',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['user_create_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments0()
    {
        return $this->hasMany(Comments::className(), ['user_employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['user_create_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Tasks::className(), ['user_employee_id' => 'id']);
    }
}
