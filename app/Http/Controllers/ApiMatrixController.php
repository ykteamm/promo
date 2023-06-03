<?php

namespace App\Http\Controllers;

use App\Models\HistoryMoneyArrival;
use App\Models\Money;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PromoHistory;
use App\Models\User;
use App\Models\UserBattle;
use App\Models\UserPharmacy;
use App\Models\UserPromoBall;
use Illuminate\Http\Request;

class ApiMatrixController extends Controller
{
    public function orders()
    {
        $orders = Order::with('orderProduct','user','orderProduct.product','user.pharmacy')->orderBy('created_at','DESC')->orderBy('status','ASC')->get();

        return response()->json($orders);
    }

    public function changeStatus(Request $request)
    {

        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();

        return $order;
    }

    public function allProvizors()
    {
        $provizors = User::all();

        return response()->json($provizors);
    }

    public function moneyArrival(Request $request)
    {

        $qarzs = Order::where('user_id',$request->provizor_id)
            ->whereRaw('order_price > money_arrival')
            ->where('status',4)
            ->where('close',0)
            ->orderBy('id','ASC')
            ->first();
        if($qarzs)
        {
            if(($qarzs->order_price - $qarzs->money_arrival) >= $request->money)
            {
                $history = new HistoryMoneyArrival;
                $history->user_id = $request->provizor_id;
                $history->money = $request->money;
                $history->add_date = $request->date;
                $history->save();

                $this->updateUserMoney($request->provizor_id,$request->money);
                $this->updateFixedBonus($request->provizor_id,$request->money);

                $qarz = Order::where('user_id',$request->provizor_id)
                    ->whereRaw('order_price > money_arrival')
                    ->where('status',4)
                    ->where('close',0)
                    ->orderBy('id','ASC')
                    ->get();

                if(count($qarz) > 0)
                {
                    $money = $request->money;

                    foreach ($qarz as $q) {

                        $diff = $q->order_price - $q->money_arrival;

                        if($money > $diff)
                        {
                            // $plus = $money - $diff;
                            $money = $money - $diff;
                            $active_order_update = Order::find($q->id);
                            $active_order_update->money_arrival = $q->money_arrival + $money;
                            $active_order_update->close = 1;
                            $active_order_update->save();

                            $this->updatePromoBall($q->id,$money,$request->provizor_id);




                        }elseif($money < $diff)
                        {

                            $active_order_update = Order::find($q->id);
                            $active_order_update->money_arrival = $q->money_arrival + $money;
                            $active_order_update->save();

                            $this->updatePromoBall($q->id,$money,$request->provizor_id);

                            $money = 0;

                        }elseif($money = $diff)
                        {

                            $active_order_update = Order::find($q->id);
                            $active_order_update->money_arrival = $q->money_arrival + $money;
                            $active_order_update->close = 1;
                            $active_order_update->save();
                            $this->updatePromoBall($q->id,$money,$request->provizor_id);
                            $money = 0;

                        }
                        // if($money > 0)
                        // {
                        //     $this->updatePromoBall($q->id,$money,$request->provizor_id);
                        // }

                        else{
                            return [
                                'status' => 200,
                            ];
                        }

                    }
                }else{
                    return [
                        'status' => 300,
                    ];
                }


                return [
                    'status' => 200,
                ];
            }else{
                return [
                    'status' => 300,
                ];
            }

        }else{
            return [
                'status' => 300,
            ];
        }

    }

    public function battleStore(Request $request)
    {
        $battle = new UserBattle;
        $battle->u1id = $request->u1id;
        $battle->u2id = $request->u2id;
        $battle->money1 = 0;
        $battle->money2 = 0;
        $battle->start_day = $request->start_date;
        $battle->end_day = $request->end_date;
        $battle->save();

        if($battle)
        {
            $status = 200;
        }else{
            $status = 200;
        }

        return [
            'status' => $status
        ];
    }

    public function getOrder(Request $request)
    {
        $order = OrderProduct::with('product')->where('order_id',$request->order_id)->get();
        $user_id = Order::find($request->order_id);
        $user = User::find($user_id->user_id);
        $name = $user->last_name.' '.$user->first_name;
        $count = count($order);
        return [
            'order' => $order,
            'count' => $count,
            'name' => $name,
        ];

    }
    public function updatePromoBall($order_id,$summ,$id)
    {

        $my_battle = UserBattle::with('u1ids','u2ids')
            ->where(function($query) use ($id){
                        $query->where('u1id',$id)
                        ->orWhere('u2id',$id);
                    })->where('ends',0)->first();
        if(!$my_battle)
        {
            $active_order_update = Order::find($order_id);

            $foiz = (($active_order_update->promo_price)*100)/($active_order_update->order_price);
            $promo_b = round(($summ)*$foiz/100*0.1);

            $promo_ball = UserPromoBall::where('user_id',$id)->first();
            if($promo_ball)
                {
                    $promo_ball->promo_ball = $promo_ball->promo_ball + $promo_b;
                    $promo_ball->save();
                }else{
                    $promo_ball = new UserPromoBall;
                    $promo_ball->user_id = $id;
                    $promo_ball->promo_ball = $promo_ball->promo_ball + $promo_b;
                    $promo_ball->save();
                }

            PromoHistory::create([
                'user_id' => $id,
                'order_id' => $order_id,
                'money_arrival' => $summ,
                'promo_ball' => $promo_b,
            ]);



        }
    }
    public function updateUserMoney($id,$sum)
        {
            $my_battle = UserBattle::with('u1ids','u2ids')
            ->where(function($query) use ($id){
                        $query->where('u1id',$id)
                        ->orWhere('u2id',$id);
                    })->where('ends',0)->first();

            if(!$my_battle)
            {
                $promo_b = round($sum*0.1);

                $promo_ball = UserPromoBall::where('user_id',$id)->first();
            if($promo_ball)
                {
                    $promo_ball->promo_ball = $promo_ball->promo_ball + $promo_b;
                    $promo_ball->save();
                }else{
                    $promo_ball = new UserPromoBall;
                    $promo_ball->user_id = $id;
                    $promo_ball->promo_ball = $promo_ball->promo_ball + $promo_b;
                    $promo_ball->save();
                }

            }
        }

        public function updateFixedBonus($id,$sum)
        {
            $my_battle = UserBattle::with('u1ids','u2ids')
            ->where(function($query) use ($id){
                        $query->where('u1id',$id)
                        ->orWhere('u2id',$id);
                    })->where('ends',0)->first();

            if(!$my_battle)
            {
                $promo_b = round($sum*0.1);
                $promo_ball = UserPromoBall::where('user_id',$id)->first();
                if($promo_ball)
                {
                    $promo_ball->promo_ball = $promo_ball->promo_ball + $promo_b;
                    $promo_ball->save();
                }else{
                    $promo_ball = new UserPromoBall;
                    $promo_ball->user_id = $id;
                    $promo_ball->promo_ball = $promo_ball->promo_ball + $promo_b;
                    $promo_ball->save();
                }

            }
        }
        public function moneys()
        {
            // $moneys = Order::with('user','user.history_money')->where('close',0)->orderBy('id','ASC')->get();
            $orders = Order::with('user','user.history_money','user.pharmacy')->orderBy('id','DESC')->orderBy('status','DESC')->get();

            return response()->json($orders);

        }

        public function userDelete($id,$parol)
        {
            if($parol == 1999)
            {
                $moneys = HistoryMoneyArrival::where('user_id',$id)->delete();
                $promo = PromoHistory::where('user_id',$id)->delete();
                $promob = UserPromoBall::where('user_id',$id)->delete();
                $userp = UserPharmacy::where('user_id',$id)->delete();
                $u1id = UserBattle::where('u1id',$id)->delete();
                $u2id = UserBattle::where('u2id',$id)->delete();

                $orders = Order::where('user_id',$id)->get();
                foreach($orders as $or)
                {
                    $ord = Order::where('id',$or->id)->delete();
                    $ord_pro = OrderProduct::where('order_id',$or->id)->delete();
                }

                $user = User::where('id',$id)->delete();
            }


        }



}
