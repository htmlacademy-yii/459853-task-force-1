<?php

namespace frontend\controllers;

use frontend\models\Category;
use frontend\models\Tasks;
use frontend\models\TasksForm;
use Yii;
use yii\web\Controller;

class TasksController extends Controller
{
    private $select = [
        'response' => 'Без откликов',
        'freelance' => 'Удаленная работа'
    ];

    private $date = [
        'day' => 'За день',
        'week' => 'За неделю',
        'month' => 'За месяц'
    ];

    public function actionIndex()
    {
        $query = Tasks::find()->with('category')->where(['status_id' => 1]);
        $tasksForm = new TasksForm();

        if (Yii::$app->request->getIsGet()) {
            $tasksForm->load(Yii::$app->request->get());

            foreach ($tasksForm as $key => $data) {
                if ($data) {

                    switch ($key) {
                        case 'categories':
                            $query->andWhere(['category_id' => $data]);
                            break;
                        case 'additional':
                            if ($data === 'response') {
                                $query->andWhere(['user_employee_id' => NULL]);
                            } else if ($data === 'freelance') {
                                $query->andWhere(['location' => NULL]);
                            }
                            break;
                        case 'search':
                            $query->andWhere(['LIKE', 'title', $data]);
                            break;

                    }
                }

            }
        }

        $tasks = $query->orderBy(['created_at' => 'DESC'])->all();

        return $this->render('index', [
            'tasks' => $tasks,
            'tasksForm' => $tasksForm,
            'categories' => Category::find()->select('name')->indexBy('id')->column(),
            'select' => $this->select,
            'date' => $this->date
        ]);
    }
}