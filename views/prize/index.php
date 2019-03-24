<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>
    <h1>Prizes</h1>
    <div>
        <?
        if($result['convert_status']){
            echo '<div>'.$result['convert_status'].'</div>';
        }

        ?>
        <p>Congratulations!</p>
        <p>
            <? if ($result['prize_is_generated']) { ?>
                <p>Вы уже сгенерировали свой приз:</p>
            <? } else { ?>
                <p>Приз не сгенерирован</p>
            <? } ?>
        </p>


        <p>your prize: <?= $result['prize_name'] ?></p>
        <p>count: <?= $result['prize_count'] ?></p>
        <p>prize type: <?= $result['prize_type'] ?></p>
        <p>
            <? if ($result['prize_is_issued']) { ?>
                вы уже получили свой приз
            <? } else { ?>
                В ближайшее время ваш приз будет перечислен на Ваш счет
            <? } ?>
        </p>

        <a href="index.php?r=prize/index&new_prize=1" class="btn btn-lg btn-danger">Отказаться от приза</a>

    </div>
