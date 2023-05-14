<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('order',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function orderStore(Request $request)
    {

        // return $request;

        $order_count = Order::where('user_id',$request['provizor_id'])->count();

        $order = new Order;
        $order->user_id = $request['provizor_id'];
        $order->order_price = $request['order_price'];
        $order->promo_price = $request['promo_price'];
        $order->money_arrival = 0;
        $order->close = 0;
        $order->number = $order_count+1;
        $order->save();

        foreach ($request['order'] as $key => $value) {

            $order_product = new OrderProduct;
            $order_product->order_id = $order->id;
            $order_product->product_id = $value['medicine_id'];
            $order_product->quantity = $value['number'];
            $order_product->product_price = $value['price_product'];
            $order_product->save();

        }

        // return $arr;
        if($order)
        {
            return [
                'status' => 200
            ];
        }else{
            return [
                'status' => 300
            ];
        }
    }

    public function changeOrderStatus($order_id,$status)
    {

        $order = Order::find($order_id);
        $order->status = $status;
        $order->save();
        return redirect()->back();
    }


}
