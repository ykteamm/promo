<?php

namespace App\Http\Controllers;

use App\Models\HistoryMoneyArrival;
use App\Models\Order;
use App\Models\OrderProduct;
use Stevebauman\Location\Facades\Location;
// use Stevebauman\Location\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserBattle;
use App\Services\UserBattleServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $response = Http::get('https://jang.novatio.uz/api/outer-market');

        // $sd = new UserBattleServices;
        // $ff = $sd->endBattle('2023-05-27');

        $res_market = Http::get(getBattleUrl().'/api/outer-market');

        $markets = json_decode($res_market);

        $orders = Order::with('orderProduct','orderProduct.product','orderProduct.product.orderStock')->where('user_id',Auth::id())->orderBy('id','ASC')->get();

        $active_order = Order::with('orderProduct','orderProduct.product.orderStock')->where('user_id',Auth::id())
        ->where('status',4)
        ->orderBy('id','DESC')
        ->first();

        $my_id = Auth::id();

        $my_battle = UserBattle::with('u1ids','u2ids')
            ->where(function($query) use ($my_id){
                        $query->where('u1id',$my_id)
                        ->orWhere('u2id',$my_id);
                    })->where('ends',0)->first();
        if($active_order)
        {
            $qarz = Order::with('orderProduct','orderProduct.product.orderStock')->where('user_id',Auth::id())
            ->whereRaw('order_price > money_arrival')
            ->where('status',4)
            ->where('id','!=',$active_order->id)
            ->orderBy('id','ASC')
            ->get();
        }else{
            $qarz = null;
        }

        // return $qarz;

            return view('home',[
                'orders' => $orders,
                'active_order' => $active_order,
                'my_battle' => $my_battle,
                'qarz' => $qarz,
                'markets' => $markets,
            ]);
    }
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }
}
