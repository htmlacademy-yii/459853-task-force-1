<?php

namespace frontend\models;

use yii\base\Model;

class TasksForm extends Model
{
    public $categories;
    public $additional;
    public $time;
    public $search;

    public function attributeLabels()
    {
        return [
            'categories' => 'Категории',
            'additional' => 'Дополнительно',
            'time' => 'Период',
            'search' => 'Поиск по названию'
        ];
    }

    public function rules()
    {
        return [
            [['categories', 'additional', 'time', 'search'], 'safe'],
        ];
    }
}