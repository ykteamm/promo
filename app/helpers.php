<?php

use App\Models\HistoryMoneyArrival;
use App\Models\UserPromoBall;
use Illuminate\Support\Facades\Auth;

if(!function_exists('getHostNameUrl')){
    function getHostNameUrl() {

        // $host = substr(request()->getHttpHost(),0,3);

        return 1000;

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

if(!function_exists('getMyPromoBall')){
    function getMyPromoBall() {

        $promo = UserPromoBall::where('user_id',Auth::id())->first();

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




