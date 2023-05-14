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

            $promo1 = round($user1_money*0.06,1);
            $promo2 = round($user2_money*0.06,1);



            if($user1_money > $user2_money)
            {
                $promo_ball1 = $promo1+$promo2;
                $promo_ball2 = 0;

                $this->endBattleStore($user1_money,$user2_money,$value->u1id,$value->u2id,$promo_ball1,$promo_ball2,$value->id);
            }elseif($user1_money < $user2_money)
            {
                $promo_ball2 = $promo1+$promo2;
                $promo_ball1 = 0;

                $this->endBattleStore($user1_money,$user2_money,$value->u2id,$value->u1id,$promo_ball1,$promo_ball2,$value->id);
            }else{
                $this->endDraw($user1_money,$user2_money,$promo1,$promo2,$value->id,$value->u1id,$value->u2id);
            }
        }

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
    public function endDraw($money1,$money2,$promo1,$promo2,$id,$u1id,$u2id)
    {
        $battle = UserBattle::find($id);
        $battle->money1 = $money1;
        $battle->money2 = $money2;
        $battle->promo_ball1 = $promo1;
        $battle->promo_ball2 = $promo2;
        $battle->ends = 1;
        $battle->save();

        $promo_ball = UserPromoBall::where('user_id',$u1id)->first();
        $promo_ball->promo_ball = $promo_ball->promo_ball + $promo1;
        $promo_ball->save();

        $promo_ball2 = UserPromoBall::where('user_id',$u2id)->first();
        $promo_ball2->promo_ball = $promo_ball2->promo_ball + $promo2;
        $promo_ball2->save();
    }


}
