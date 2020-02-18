<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\Tasks;
use frontend\models\TasksForm;
use Yii;
use yii\web\Controller;

class TasksController extends Controller
{

    public function actionIndex()
    {
        $query = Tasks::find()->with('category')->where(['status_id' => 1]);
        $tasksForm = new TasksForm();

        if (Yii::$app->request->getIsPost()) {
            $formData = Yii::$app->request->post();
            if ($tasksForm->load($formData) && $tasksForm->validate()) {

                if ($tasksForm->replies) {
                    $query->leftJoin('comments', 'comments.task_id = tasks.id');
                    $query->andWhere(['or',
                        ['comments.task_id' => null],
                        ['tasks.id' => null]
                    ]);
                }

                if ($tasksForm->categories) {
                    $categories = ['or'];
                    foreach ($tasksForm->categories as $category) {
                        $categories[] = [
                            'tasks.category_id' => $category + 1
                        ];
                    }
                    $query->andWhere($categories);
                }

                if ($tasksForm->location) {
                    $query->andWhere(['tasks.location' => null]);
                }

                if ($tasksForm->period === 'day') {
                    $query->andWhere(['>', 'tasks.created_at', date("Y-m-d H:i:s", strtotime("- 1 day"))]);
                } elseif ($tasksForm->period === 'week') {
                    $query->andWhere(['>', 'tasks.created_at', date("Y-m-d H:i:s", strtotime("- 1 week"))]);
                } elseif ($tasksForm->period === 'month') {
                    $query->andWhere(['>', 'tasks.created_at', date("Y-m-d H:i:s", strtotime("- 1 month"))]);
                }

                if (!empty($tasksForm->search)) {
                    $query->andWhere(['like', 'tasks.title', $tasksForm->search]);
                }
            }
        }

        $tasks = $query->orderBy(['created_at' => 'DESC'])->all();

        return $this->render('index', [
            'tasks' => $tasks,
            'tasksForm' => $tasksForm
        ]);
    }
}