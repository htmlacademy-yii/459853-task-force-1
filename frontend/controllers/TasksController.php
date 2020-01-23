<?php

namespace frontend\controllers;

use app\models\Tasks;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Tasks::find()->with('category')->where(['status_id' => 1])->orderBy(['created_date' => ORDER_DESC])->all();
        return $this->render('index', ['tasks' => $tasks]);
    }
}