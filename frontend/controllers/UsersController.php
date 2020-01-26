<?php


namespace frontend\controllers;

use frontend\models\Users;
use yii\web\Controller;
use yii\db\Query;

class UsersController extends Controller
{
    public function actionIndex() {
        $query = new Query();
        $query
            ->select(['u.name', 'u.description', 'u.lastname'])
            ->from('users u')
            ->join('JOIN', 'category_to_user ctu', 'u.id = ctu.user_id')
            ->distinct();

        $users = $query->all();

        return $this->render('index', ['users' => $users]);
    }
}