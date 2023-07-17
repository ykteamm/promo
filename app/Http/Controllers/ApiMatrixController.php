<?php

namespace App\Http\Controllers;

use App\Models\HistoryMoneyArrival;
use App\Models\Medicine;
use App\Models\Money;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStock;
use App\Models\PriceMedicine;
use App\Models\PromoHistory;
use App\Models\User;
use App\Models\UserBattle;
use App\Models\UserPharmacy;
use App\Models\UserPromoBall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiMatrixController extends Controller
{
    public function orders()
    {
        $orders = Order::with('orderProduct','orderStock','user','orderProduct.product','user.pharmacy')->orderBy('created_at','DESC')->orderBy('status','ASC')->get();

        return response()->json($orders);
    }

    public function hisobot()
    {
        $orders = User::with('order')
        ->get();

        $orders = User::with([
            'order' => function($q) {
                $q->where('status','!=',5);
            }])
            ->get();

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
    public function getMedicine()
    {
        $medicine = Medicine::with('price')->get();

        return $medicine;
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
    public function proIds()
    {
        return [36,37,38,39,29,47,61,62,63,64,65];
    }
    public function orderUpdate(Request $request)
    {

        $proId = $this->proIds();

        $allsum = 0;
        $promosum = 0;

        foreach($request->product as $key => $value)
        {
            $price = PriceMedicine::where('medicine_id',$key)->first()->price;

            $allsum += $price*$value;

            if(in_array($key,$proId))
            {
                $promosum += $price*$value;
            }

            $op = OrderProduct::where('order_id',$request->order_id)->where('product_id',$key)
            ->update([
                'quantity' => $value
            ]);
        }
            $op = Order::where('id',$request->order_id)
            ->update([
                'order_price' => $allsum,
                'promo_price' => $promosum,
            ]);
            return response([
                'status' => 200
            ]);
    }
    public function orderDelete(Request $request)
    {

        $order_id = $request->order_id;

        DB::table('orders')->where('id',$order_id)->delete();
        DB::table('order_products')->where('order_id',$order_id)->delete();
        DB::table('order_stocks')->where('order_id',$order_id)->delete();
        DB::table('promo_histories')->where('order_id',$order_id)->delete();
        
            return response([
                'status' => 200
            ]);
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
            $orders = Order::with('user','user.history_money','user.pharmacy')->whereIn('status',[3,4])->orderBy('id','DESC')->orderBy('status','DESC')->get();

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
                    $ord_pro = OrderStock::where('order_id',$or->id)->delete();
                }

                $user = User::where('id',$id)->delete();
            }


        }

        public function orderUser(Request $request)
            {
                $orders = User::with('order','order.orderProduct','order.orderProduct.product','stock')->whereIn('region_id',$request['regions'])->get();
                return [
                    'orders' => $orders
                ];
            }

        public function productSave(Request $request)
        {
            $products = $request->product;
            $user_id = $request->user_id;
            $order_id = $request->order_id;

            $money_arrival = Order::find($order_id)->money_arrival;

            $sum = 0;
            $stock_sum = 0;
            foreach ($products as $key => $value) {
                if($value[0] != null)
                {

                    $order_products = OrderProduct::where('order_id',$order_id)
                    ->where('product_id',$key)
                    ->first();

                    $stock_products = OrderStock::where('order_id',$order_id)
                    ->where('product_id',$key)
                    ->sum('quantity');

                    $all_stock = $order_products->quantity - $stock_products;


                    if($all_stock < $value[0])
                    {
                        return response([
                            'status' => 300,
                            'msg' => 'Kiritayotgan dori soni buyurtmadan oshib ketdi',
                        ]);
                        break;
                    }

                    $sum += $order_products->product_price*$value[0];
                    $stock_sum += $order_products->product_price*$stock_products;
                }
            }


            if($sum > ($money_arrival-$stock_sum))
            {
                return response([
                    'status' => 300,
                    'msg' => 'Dorilarning summasi pul kelishidan oshib ketdi',
                ]);
            }else{
                $crystal = 0;
                foreach ($products as $key => $value) {
                    if($value[0] != null)
                    {

                        $order_products = OrderProduct::where('order_id',$order_id)
                        ->where('product_id',$key)
                        ->first();



                        $pr = $this->crstal($key,$value[0]);

                        $crystal = $crystal + $pr;

                        $stock = new OrderStock;
                        $stock->user_id = $user_id;
                        $stock->order_id = $order_id;
                        $stock->product_id = $key;
                        $stock->quantity = $value[0];
                        $stock->product_price = $order_products->product_price;
                        $stock->save();
                    }
                }

                $this->promoCrs($user_id,$crystal);
            }

            return response([
                'status' => 200,
                'msg' => 'Saqlandi',
            ]);

        }
        public function promoCrs($id,$crystal)
        {
                $my_battle = UserBattle::with('u1ids','u2ids')
                            ->where(function($query) use ($id){
                                        $query->where('u1id',$id)
                                        ->orWhere('u2id',$id);
                                    })->where('ends',0)->first();

                if(!$my_battle)
                {
                    $promo_b = $crystal;

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

        public function promoCrsUpdate($id,$crystal)
        {

            $promo_b = $crystal;

            $promo_ball = UserPromoBall::where('user_id',$id)->first();

            if($promo_ball)
                {
                    $promo_ball->promo_ball = $promo_b;
                    $promo_ball->save();
                }else{
                    $promo_ball = new UserPromoBall;
                    $promo_ball->user_id = $id;
                    $promo_ball->promo_ball = $promo_b;
                    $promo_ball->save();
                }

        }

        public function crstal($key,$soni)
        {

            $proId = $this->proIds();

            if($key == 61)
            {
                $all_price = 0;

                $ids = [39,38,4];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.25;
                    }else{
                        $all_price += $soni*$price->price*0.2;
                    }
                }
            }elseif($key == 62)
            {
                $all_price = 0;

                $ids = [36,51,27];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.25;
                    }else{
                        $all_price += $soni*$price->price*0.2;
                    }
                }
            }
            elseif($key == 63)
            {
                $all_price = 0;

                $ids = [29,4,7];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.25;
                    }else{
                        $all_price += $soni*$price->price*0.2;
                    }
                }
            }
            elseif($key == 64)
            {
                $all_price = 0;

                $ids = [47,39,4];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.25;
                    }else{
                        $all_price += $soni*$price->price*0.2;
                    }
                }
            }
            elseif($key == 65)
            {
                $all_price = 0;

                $ids = [26,39,4,51];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.25;
                    }else{
                        $all_price += $soni*$price->price*0.2;
                    }
                }
            }elseif(in_array($key,$proId))
            {
                $price = PriceMedicine::where('medicine_id',$key)->first();

                $all_price = $soni*$price->price*0.25;

            }else{
                $price = PriceMedicine::where('medicine_id',$key)->first();

                $all_price = $soni*$price->price*0.2;
            }
            return $all_price;
        }
        public function crstalLoser($key,$soni)
        {

            $proId = $this->proIds();

            if($key == 61)
            {
                $all_price = 0;

                $ids = [39,38,4];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.05;
                    }else{
                        $all_price += 0;
                    }
                }
            }elseif($key == 62)
            {
                $all_price = 0;

                $ids = [36,51,27];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.05;
                    }else{
                        $all_price += 0;
                    }
                }
            }
            elseif($key == 63)
            {
                $all_price = 0;

                $ids = [29,4,7];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.05;
                    }else{
                        $all_price += 0;
                    }
                }
            }
            elseif($key == 64)
            {
                $all_price = 0;

                $ids = [47,39,4];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.05;
                    }else{
                        $all_price += 0;
                    }
                }
            }
            elseif($key == 65)
            {
                $all_price = 0;

                $ids = [26,39,4,51];
                foreach($ids as $i)
                {
                    $price = PriceMedicine::where('medicine_id',$i)->first();

                    if(in_array($i,$proId))
                    {
                        $all_price += $soni*$price->price*0.05;
                    }else{
                        $all_price += 0;
                    }
                }
            }elseif(in_array($key,$proId))
            {
                $price = PriceMedicine::where('medicine_id',$key)->first();

                $all_price = $soni*$price->price*0.05;

            }else{
                $price = PriceMedicine::where('medicine_id',$key)->first();

                $all_price = 0;
            }
            return $all_price;
        }

        public function productSaveTest()
        {
            $user_ids = OrderStock::distinct('user_id')->pluck('user_id')->toArray();

            $p = [];

            foreach($user_ids as $ids)
            {


                $products = OrderStock::where('user_id',$ids)->get();
             
                    $crystal = 0;
                    foreach ($products as $key => $pro) {

                            $pr = $this->crstal($pro->product_id,$pro->quantity);

                            $crystal = $crystal + $pr;  
                    }
                    $this->promoCrsUpdate($ids,$crystal);
            }
            
            return $p;

        }
}
