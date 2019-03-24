<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Admin Panel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Список пользователей которым еще не зачислены призы:</p>

    <ul>
        <? foreach ($awardedUsers as $user) { ?>
            <li><?= $user->username ?> - <?= $user->prize_name ?> - <?= $user->prize_count ?></li>
        <? } ?>
    </ul>

    <p>
        <a href="index.php?r=prize/index&bank=1" class="btn btn-lg btn-info">Перечислить в банк HTTP Запросом</a>
    </p>


    <p>
        <a href="index.php?r=prize/index&convert=1" class="btn btn-lg btn-info">сконвертировать в баллы лояльности с
            учетом коэффициента.</a>
    </p>
    <p>
        <a href="index.php?r=prize/index&app=1" class="btn btn-lg btn-info">Зачислить на счет лояльности в
            приложение</a>
    </p>

</div>
