<?php

namespace App\Services;

use App\Http\Controllers\ApiMatrixController;
use App\Models\OrderStock;
use App\Models\UserBattle;
use App\Models\UserPromoBall;

class UserBattleServices

{

    public function endBattle($date)
    {

        $battles = UserBattle::where('ends',0)->whereDate('end_day','=',$date)->get();

        foreach($battles as $key => $value)
        {
            $user1_money = getMoneyUser($value->start_day,$value->end_day,$value->u1id);
            $user2_money = getMoneyUser($value->start_day,$value->end_day,$value->u2id);

            // dd($user2_money);

            if($user1_money > $user2_money)
            {
                $this->endBattleStoreWin1($value);

            }elseif($user1_money < $user2_money)
            {
                $this->endBattleStoreWin2($value);

                // $this->endBattleStoreWin1($value->start_day,$value->end_day,$user1_money,$user2_money,$value->u2id,$value->u1id,$value->id);

            }else{
                $this->endDraw($value->start_day,$value->end_day,$user1_money,$user2_money,$value->id,$value->u1id,$value->u2id);
            }
        }

    }
    public function getWinBonus($start_day,$end_day,$win,$lose)
    {
        $stocks = OrderStock::whereDate('created_at','>=',$start_day)
        ->whereDate('created_at','<=',$end_day)
        ->where('user_id',$win)->get();

        $crystal = 0;
            foreach ($stocks as $key => $value) {
                $ser = new ApiMatrixController;
                $pr = $ser->crstal($value->product_id,$value->quantity);
                $crystal = $crystal + $pr;
            }

        $stocks2 = OrderStock::whereDate('created_at','>=',$start_day)
            ->whereDate('created_at','<=',$end_day)
            ->where('user_id',$lose)->get();

        $crystal2 = 0;
                foreach ($stocks2 as $key2 => $value2) {
                    $ser2 = new ApiMatrixController;
                    $pr2 = $ser2->crstalLoser($value2->product_id,$value2->quantity);
                    $crystal2 = $crystal2 + $pr2;
                }

        $bonus = ($crystal+$crystal2);

        return $bonus;
    }
    public function getLoseBonus($start_day,$end_day,$lose)
    {
        $stocks = OrderStock::whereDate('created_at','>=',$start_day)
        ->whereDate('created_at','<=',$end_day)
        ->where('user_id',$lose)->get();
        $crystal = 0;
            foreach ($stocks as $key => $value) {
                $ser = new ApiMatrixController;
                $pr = $ser->crstal($value->product_id,$value->quantity);
                $crystal = $crystal + $pr;
            }

        return $crystal;
    }
    public function endBattleStoreWin1($battle)
    {
        $bonus1 = $this->getWinBonus($battle->start_day,$battle->end_day,$battle->u1id,$battle->u2id);
        $bonus2 = $this->getLoseBonus($battle->start_day,$battle->end_day,$battle->u2id);

        $money1 = getMoneyUser($battle->start_day,$battle->end_day,$battle->u1id);
        $money2 = getMoneyUser($battle->start_day,$battle->end_day,$battle->u2id);

        $battle = UserBattle::find($battle->id);
        $battle->money1 = $money1;
        $battle->money2 = $money2;
        $battle->win = $battle->u1id;
        $battle->lose = $battle->u2id;
        $battle->promo_ball1 = $bonus1;
        $battle->promo_ball2 = $bonus2;
        $battle->ends = 1;
        $battle->save();

        $this->updatePromo($battle->u1id,$bonus1);
        $this->updatePromo($battle->u2id,$bonus2);

    }
    public function endBattleStoreWin2($battle)
    {
        $bonus1 = $this->getLoseBonus($battle->start_day,$battle->end_day,$battle->u1id);
        $bonus2 = $this->getWinBonus($battle->start_day,$battle->end_day,$battle->u2id,$battle->u1id);

        $money1 = getMoneyUser($battle->start_day,$battle->end_day,$battle->u1id);
        $money2 = getMoneyUser($battle->start_day,$battle->end_day,$battle->u2id);

        $battle = UserBattle::find($battle->id);
        $battle->money1 = $money1;
        $battle->money2 = $money2;
        $battle->win = $battle->u2id;
        $battle->lose = $battle->u1id;
        $battle->promo_ball1 = $bonus1;
        $battle->promo_ball2 = $bonus2;
        $battle->ends = 1;
        $battle->save();

        $this->updatePromo($battle->u1id,$bonus1);
        $this->updatePromo($battle->u2id,$bonus2);

    }
    public function endBattleStore($money1,$money2,$win,$lose,$promo_ball1,$promo_ball2,$id)
    {
        $battle = UserBattle::find($id);
        $battle->money1 = $money1;
        $battle->money2 = $money2;
        $battle->win = $win;
        $battle->lose = $lose;
        $battle->promo_ball1 = $promo_ball1;
        $battle->promo_ball2 = $promo_ball2;
        $battle->ends = 1;
        $battle->save();

        $promo_ball = UserPromoBall::where('user_id',$win)->first();
        $promo_ball->promo_ball = $promo_ball->promo_ball + $promo_ball1;
        $promo_ball->save();

    }
    public function endDraw($start_day,$end_day,$money1,$money2,$id,$u1id,$u2id)
    {

        $bonus1 = $this->getLoseBonus($start_day,$end_day,$u1id);
        $bonus2 = $this->getLoseBonus($start_day,$end_day,$u2id);


        $battle = UserBattle::find($id);
        $battle->money1 = $money1;
        $battle->money2 = $money2;
        $battle->promo_ball1 = $bonus1;
        $battle->promo_ball2 = $bonus2;
        $battle->ends = 1;
        $battle->save();

        $this->updatePromo($u1id,$bonus1);
        $this->updatePromo($u2id,$bonus2);
    }

    public function updatePromo($id,$bonus)
    {
        $promo_ball = UserPromoBall::where('user_id',$id)->first();
        if($promo_ball)
            {
                $promo_ball->promo_ball = $promo_ball->promo_ball + $bonus;
                $promo_ball->save();
            }else{
                $promo_ball = new UserPromoBall;
                $promo_ball->user_id = $id;
                $promo_ball->promo_ball = $promo_ball->promo_ball + $bonus;
                $promo_ball->save();
            }
    }
}
