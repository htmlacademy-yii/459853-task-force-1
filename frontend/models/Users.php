<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $location
 * @property string $password
 * @property string $role
 * @property string|null $avatar
 * @property string|null $birth_date
 * @property string|null $attachment
 * @property string|null $phone
 * @property string|null $social
 * @property string|null $specialization_id
 * @property int|null $show_contacts
 * @property int|null $notification_email
 * @property int|null $notification_action
 * @property int|null $notification_review
 * @property string|null $last_login
 * @property string|null $created_date
 *
 * @property Comments[] $comments
 * @property Comments[] $comments0
 * @property TaskResponse[] $taskResponses
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
            [['email', 'name', 'location', 'password', 'role'], 'required'],
            [['birth_date', 'last_login', 'created_date'], 'safe'],
            [['show_contacts', 'notification_email', 'notification_action', 'notification_review'], 'integer'],
            [['email', 'location', 'avatar'], 'string', 'max' => 128],
            [['name', 'role', 'phone', 'social'], 'string', 'max' => 50],
            [['password', 'attachment', 'specialization_id'], 'string', 'max' => 255],
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
            'location' => 'Location',
            'password' => 'Password',
            'role' => 'Role',
            'avatar' => 'Avatar',
            'birth_date' => 'Birth Date',
            'attachment' => 'Attachment',
            'phone' => 'Phone',
            'social' => 'Social',
            'specialization_id' => 'Specialization ID',
            'show_contacts' => 'Show Contacts',
            'notification_email' => 'Notification Email',
            'notification_action' => 'Notification Action',
            'notification_review' => 'Notification Review',
            'last_login' => 'Last Login',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['user_employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments0()
    {
        return $this->hasMany(Comments::className(), ['user_create_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskResponses()
    {
        return $this->hasMany(TaskResponse::className(), ['user_employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['user_employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Tasks::className(), ['user_create_id' => 'id']);
    }
}
