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

class PrizeController extends Controller
{

    private $prizes_types = ['bonus points', 'money', 'phyzical item'];

    private function lototron($prizes_types)
    {
        $prize_type_id = array_rand($prizes_types);
        //print_r($prize_type_id);
        $prize_type_name = $prizes_types[$prize_type_id];

        switch ($prize_type_name) {
            case 'bonus points':
                $prize_count = random_int(100, 1000);
                $prize_name = 'Баллы лояльности';
                break;
            case "money":
                $prize_count = $this->getMoney(random_int(500, 10000));
                if ($prize_count === FALSE) {
                    unset($prizes_types[$prize_type_id]);
                    return $this->lototron($prizes_types);
                }
                $prize_name = 'Деньги';
                break;
            case 'phyzical item':
                $prize_name = $this->getPhysPrize();
                if ($prize_name === FALSE) {
                    unset($prizes_types[$prize_type_id]);
                    return $this->lototron($prizes_types);
                }
                $prize_count = 1;

                break;
        }


        User::setPrize($prize_name,$prize_type_name,$prize_count);

        return json_encode(['status' => true,
            'prize_name' => $prize_name,
            'prize_type' => $prize_type_name,
            'prize_count' => $prize_count,
            'prize_is_issued' => 0,
            'prize_is_generated' => 1,
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Сконвертируем деньги в баллы лояльности
     * @return int
     */
    private function convertation(){
        $this_user = User::getUserParams();
        if($this_user->prize_name != 'Деньги')
            return 'Невозможно сконвертировать, ваш приз это не деньги';
        else{
            $count = $this_user->prize_count;
            $ratio = Prize::find()
                ->andWhere(['param' => 'ratio'])
                ->one();

            $prize_name = 'Баллы лояльности';
            $prize_type_name = 'bonus points';
            $prize_count = $ratio->value*$count;
            User::setPrize($prize_name,$prize_type_name,$prize_count);


            return 'Успешная конвертация, получено '.$prize_count.' баллов';
        }
    }
    public function actionIndex(){
        $request = Yii::$app->request;
        $new_prize = $request->get('new_prize');
        if($new_prize){
            $to_view = json_decode($this->lototron($this->prizes_types),true);

            return $this->render('index', [
                'result' => $to_view,
            ]);
        }
        $convert = $request->get('convert');
        if ($convert){
            return $this->render('index', [
                'result' => [
                    'convert_status' => $this->convertation()
                ]
            ]);

        }

        $this_user = User::getUserParams();
        if($this_user->prize_is_generated){
            return $this->render('index', [
                'result' => [
                    'prize_name' => $this_user->prize_name,
                    'prize_type' => $this_user->prize_type,
                    'prize_count' => $this_user->prize_count,
                    'prize_is_issued' => 0,
                    'prize_is_generated' => 1,
                ],
            ]);
        } else {
            $to_view = json_decode($this->lototron($this->prizes_types),true);

            return $this->render('index', [
                'result' => $to_view,
            ]);
        }
    }

    /**
     * Выдадим деньги если возможно
     * @param $count
     * @return bool
     */
    private function getMoney($count)
    {
        $money = Prize::find()
            ->andWhere(['param' => 'money'])
            ->one();

        $money_remain = ($money->value - $count);

        if ($money_remain > 0) {
            $money->value = $money_remain;
            $money->save();
            return $count;
        } else {
            return FALSE;
        }
    }

    /**
     * Заберем один физический подарок
     * @return mixed
     */
    private function getPhysPrize()
    {
        $phys_items = PrizePhysType::find()
            //->andWhere(['count' => '10'])
            ->where(['>', 'count', 0])
            ->all();
        $arr = [];

        if (!empty($phys_items)) {
            foreach ($phys_items as $item) {
                $arr[$item->id] = $item->name;
            }

            $prize_id = array_rand($arr);
            $prize_name = $arr[$prize_id];

            $phys_item = PrizePhysType::find()
                ->where(['id' => $prize_id])
                ->one();

            $phys_item->count = $phys_item->count - 1;

            $phys_item->save();
            return $prize_name;
        } else {
            return FALSE;
        }
    }
}