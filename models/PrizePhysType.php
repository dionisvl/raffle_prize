<?php

namespace app\models;

use yii\db\ActiveRecord;

use Yii;
use yii\base\Model;

/**
 * Физический предмет - случайный предмет из списка.
 */

class PrizePhysType extends ActiveRecord
{
    public static function tableName()
    {
        return 'phys_prizes';
    }
}