<?php

namespace App\Services;

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

            if($user1_money > $user2_money)
            {
                $this->endBattleStoreWin1($value->start_day,$value->end_day,$user1_money,$user2_money,$value->u1id,$value->u2id,$value->id);

                // $this->endBattleStore($user1_money,$user2_money,$value->u1id,$value->u2id,$promo_ball1,$promo_ball2,$value->id);

            }elseif($user1_money < $user2_money)
            {
                // $promo_ball2 = $promo1+$promo2;
                // $promo_ball1 = 0;

                // $this->endBattleStore($user1_money,$user2_money,$value->u2id,$value->u1id,$promo_ball1,$promo_ball2,$value->id);

                $this->endBattleStoreWin1($value->start_day,$value->end_day,$user1_money,$user2_money,$value->u2id,$value->u1id,$value->id);

            }else{
                $this->endDraw($value->start_day,$value->end_day,$user1_money,$user2_money,$value->id,$value->u1id,$value->u2id);
            }
        }

    }

    public function endBattleStoreWin1($start_day,$end_day,$money1,$money2,$win,$lose,$battle_id)
    {
        $bonus1 = getMoneyUserBonus($start_day,$end_day,$win,$lose);
        $bonus2 = getMoneyLoseUserBonus($start_day,$end_day,$lose);

        $battle = UserBattle::find($battle_id);
        $battle->money1 = $money1;
        $battle->money2 = $money2;
        $battle->win = $win;
        $battle->lose = $lose;
        $battle->promo_ball1 = $bonus1;
        $battle->promo_ball2 = $bonus2;
        $battle->ends = 1;
        $battle->save();

        $this->updatePromo($win,$bonus1);
        $this->updatePromo($lose,$bonus2);

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

        $bonus1 = getUserBonus($start_day,$end_day,$u1id);
        $bonus2 = getUserBonus($start_day,$end_day,$u2id);

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
