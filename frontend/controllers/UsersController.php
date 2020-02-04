<?php


namespace frontend\controllers;

use yii\db\Query;
use yii\web\Controller;

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

        $users = $users_query->all();


        return $this->render('index', ['users' => $users]);
    }
}