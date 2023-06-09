<?php

use App\Models\HistoryMoneyArrival;
use App\Models\Order;
use App\Models\UserPromoBall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

if(!function_exists('getHostNameUrl')){
    function getHostNameUrl() {

        $host = substr(request()->getHttpHost(),0,3);

        return $host;

    }
}

if(!function_exists('getBattleUrl')){
    function getBattleUrl() {

        if(getHostNameUrl() == 127)
        {
            $url = 'http://127.0.0.1:8888';
        }else{
            $url = 'https://jang.novatio.uz';
        }

        return $url;

    }
}
if(!function_exists('getMoneyUser')){
    function getMoneyUser($start_day,$end_day,$id) {

        $allprice = HistoryMoneyArrival::whereDate('add_date','>=',$start_day)
        ->whereDate('add_date','<=',$end_day)
        ->where('user_id',$id)
        ->sum('money');

        return $allprice??0;

    }
}

if(!function_exists('getMoneyUserBonus')){
    function getMoneyUserBonus($start_day,$end_day,$id,$partner_id) {

        $money1 = HistoryMoneyArrival::whereDate('add_date','>=',$start_day)
        ->whereDate('add_date','<=',$end_day)
        ->where('user_id',$id)
        ->sum('money');

        $money2 = HistoryMoneyArrival::whereDate('add_date','>=',$start_day)
        ->whereDate('add_date','<=',$end_day)
        ->where('user_id',$partner_id)
        ->sum('money');

        $active_order1 = Order::where('user_id',$id)
        ->where('status',4)
        ->orderBy('id','DESC')
        ->first();

        if($active_order1)
        {
            $foiz1 = ($active_order1->promo_price*100)/$active_order1->order_price;
        }else{
            $foiz1 = 60;
        }

        $active_order2 = Order::where('user_id',$partner_id)
        ->where('status',4)
        ->orderBy('id','DESC')
        ->first();

        if($active_order2)
        {
            $foiz2 = ($active_order2->promo_price*100)/$active_order2->order_price;
        }else{
            $foiz2 = 60;
        }

        $bonus = round($money1*0.2 + $money1*$foiz1/100*0.1 + $money2*$foiz2/100*0.05 + $money2*0.05);

        return $bonus;

    }
}
if(!function_exists('getMoneyLoseUserBonus')){
    function getMoneyLoseUserBonus($start_day,$end_day,$id) {

        $money1 = HistoryMoneyArrival::whereDate('add_date','>=',$start_day)
        ->whereDate('add_date','<=',$end_day)
        ->where('user_id',$id)
        ->sum('money');


        $active_order1 = Order::where('user_id',$id)
        ->where('status',4)
        ->orderBy('id','DESC')
        ->first();

        if($active_order1)
        {
            $foiz1 = ($active_order1->promo_price*100)/$active_order1->order_price;
        }else{
            $foiz1 = 60;
        }

        $bonus = round($money1*0.05 + $money1*$foiz1/100*0.05 + $money1*0.1);

        return $bonus;

    }
}
if(!function_exists('getUserBonus')){
    function getUserBonus($start_day,$end_day,$id) {

        $money1 = HistoryMoneyArrival::whereDate('add_date','>=',$start_day)
        ->whereDate('add_date','<=',$end_day)
        ->where('user_id',$id)
        ->sum('money');


        $active_order1 = Order::where('user_id',$id)
        ->where('status',4)
        ->orderBy('id','DESC')
        ->first();

        if($active_order1)
        {
            $foiz1 = ($active_order1->promo_price*100)/$active_order1->order_price;
        }else{
            $foiz1 = 60;
        }

        $bonus = round($money1*0.2 + $money1*$foiz1/100*0.1);

        return $bonus;

    }
}
if(!function_exists('getMyPromoBall')){
    function getMyPromoBall() {

        $promo = UserPromoBall::where('user_id',Auth::id())->first();
        if(!$promo)
        {
            $promo = new UserPromoBall;
            $promo->user_id = Auth::id();
            $promo->promo_ball = 0;
            $promo->save();
        }
        return $promo;

    }
}

if(!function_exists('getMyMaosh')){
    function getMyMaosh() {

        $money = HistoryMoneyArrival::where('user_id',Auth::id())->sum('money')??0;

        $money = $money*0.1;

        return $money;

    }
}

if(!function_exists('getReyting')){
    function getReyting() {


        $reyting = HistoryMoneyArrival::with('user')->selectRaw('SUM(money) as allmoney,user_id')
        ->orderBy('allmoney','DESC')
        ->groupBy('user_id')->get();

        return $reyting;
    }
}

// if(!function_exists('getMarketData')){
//     function getMarketData() {

//         // $response = Http::get('https://jang.novatio.uz/api/outer-market');
//         $response = Http::get('http://127.0.0.1:8888/api/outer-market');

//         return $response;
//     }
// }


