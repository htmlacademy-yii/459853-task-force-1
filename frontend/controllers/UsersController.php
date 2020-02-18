<?php


namespace frontend\controllers;

use yii\db\Query;
use yii\web\Controller;
use frontend\models\UsersForm;
use Yii;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $users_ids = new Query();
        $users_ids
            ->select('ctu.user_id')
            ->from('category_to_user ctu')
            ->distinct();

//        $comments = new Query();
//        $comments
//            ->select(['c.user_employee_id', 'COUNT(*) AS total_comments'])
//            ->from('comments c')
//            ->where(['user_employee_id' => $users_ids])
//            ->groupBy('c.user_employee_id');
//
//        $comments_query = $comments->all();

        $users_query = new Query();
        $users_query
            ->select(['u.*'])
            ->from('users u')
            ->where(['u.id' => $users_ids])
            ->groupBy('u.id');


        $form = new UsersForm();

        if (Yii::$app->request->getIsPost()) {
            $formData = Yii::$app->request->post();
            if ($form->load($formData) && $form->validate()) {
                if ($form->categories) {
                    $users_query->leftJoin('category_to_user ctu', 'ctu.user_id = u.id');
                    $users_query->andWhere(['ctu.category_id' => $form->categories]);
                }

                if (!empty($form->search)) {
                    $users_query->andWhere(['like', 'u.name', $form->search]);
                }
            }
        }

        $users = $users_query->all();


        return $this->render('index', ['users' => $users, 'usersForm' => $form]);
    }
}