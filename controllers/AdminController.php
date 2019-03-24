<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Prize;
use app\models\PrizePhysType;
use app\models\User;
use Yii;

function dd($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    die();
}

class AdminController extends Controller
{

    public function actionIndex(){

        $awardedUsers = User::getAwardedUsers();


            return $this->render('index', [
                'awardedUsers' => $awardedUsers,
            ]);
    }
}