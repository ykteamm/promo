<?php

namespace App\Http\Controllers;

use App\Models\HistoryMoneyArrival;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\UserBattle;
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

        $history = new HistoryMoneyArrival;
        $history->user_id = $request->provizor_id;
        $history->money = $request->money;
        $history->add_date = $request->date;
        $history->save();

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
                    $active_order_update->money_arrival = $q->money_arrival + $diff;
                    $active_order_update->close = 1;
                    $active_order_update->save();

                }elseif($money < $diff)
                {

                    $active_order_update = Order::find($q->id);
                    $active_order_update->money_arrival = $q->money_arrival + $money;
                    $active_order_update->save();
                    $money = 0;

                }elseif($money = $diff)
                {

                    $active_order_update = Order::find($q->id);
                    $active_order_update->money_arrival = $q->money_arrival + $money;
                    $active_order_update->close = 1;
                    $active_order_update->save();

                    $money = 0;

                }
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

        return $order;

    }

}
