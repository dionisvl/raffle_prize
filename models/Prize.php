<?php

namespace app\models;

use yii\db\ActiveRecord;

use Yii;
use yii\base\Model;

class Prize extends ActiveRecord
{
    public static function tableName()
    {
        return 'prize_params';
    }
}