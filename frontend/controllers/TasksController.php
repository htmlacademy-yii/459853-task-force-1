<?php

namespace frontend\controllers;

use frontend\models\Tasks;
use frontend\models\TasksForm;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Tasks::find()->with('category')->where(['status_id' => 1])->orderBy(['created_at' => 'DESC'])->all();
        $tasksForm = new TasksForm();

        return $this->render('index', ['tasks' => $tasks, 'tasksForm' => $tasksForm]);
    }

//    public function actionShow($id) {
//        var_dump($id);
//    }
}