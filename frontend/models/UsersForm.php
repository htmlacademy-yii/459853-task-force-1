<?php

namespace frontend\models;

use yii\base\Model;

class UsersForm extends Model
{

    public $categories;
    public $work_status;
    public $available;
    public $online;
    public $comments;
    public $favorite;
    public $search;


    public function attributeLabels()
    {
        return [
            'categories'    => 'Категории',
            'work_status'   => 'Дополнительно',
            'available'     => 'Сейчас свободен',
            'online'        => 'Сейчас онлайн',
            'comments'      => 'Есть отзывы',
            'favorite'      => 'В избранном',
            'search'        => 'Поиск по имени'
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'work_status', 'available', 'online', 'comments', 'favorite', 'search'], 'safe'],
        ];
    }
}