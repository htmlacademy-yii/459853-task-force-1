<?php

namespace frontend\models;

use yii\base\Model;

class TasksForm extends Model
{
    public $categories;
    public $additionally;
    public $time;
    public $search;

    public function rules()
    {
        return [
            [['categories', 'additionally', 'time', 'search'], 'safe'],
        ];
    }
}