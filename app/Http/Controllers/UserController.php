<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function shopping()
    {
        return view('user.shopping');
    }

    public function reyting()
    {
        $users = User::orderBy('cashback','DESC')->get();
        return view('reyting',compact('users'));
    }
    public function myOrder()
    {
        $user_id = Auth::user()->id;
        $orders = Order::with('orderProduct','orderProduct.product')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('user.my-order',compact('orders'));
    }
    public function productShopping($id)
    {
        return redirect()->back()->with('test','abs');
    }
    public function nameEtap(Request $request)
    {
        Session::put('first_name',$request->first_name);
        Session::put('last_name',$request->last_name);
        Session::put('name_etap',200);
        return [
            'status' => 200,
        ];
    }

    public function dateEtap(Request $request)
    {
        Session::put('year',$request->year);
        Session::put('month',$request->month);
        Session::put('day',$request->day);
        Session::put('date_etap',200);
        return [
            'status' => 200,
            'phone' => Session::get('code_etap'),
            'code' => Session::get('phone_etap'),
        ];
    }

    public function phoneEtap(Request $request)
    {
        
        $number = preg_replace("/[^0-9]/", '', $request->phone);

        $phone = User::where('phone_number',$number)->first();
        if($phone)
        {
            return [
                'status' => 505,
            ];
        }else{
            $x = 4; // Amount of digits
            $min = pow(10,$x);
            $max = pow(10,$x+1)-1;
            $value = rand($min, $max);

            $response = Http::post('notify.eskiz.uz/api/auth/login', [
                'email' => 'mubashirov2002@gmail.com',
                'password' => 'PM4g0AWXQxRg0cQ2h4Rmn7Ysoi7IuzyMyJ76GuJa'
            ]);
            $token = $response['data']['token'];

            $sms = Http::withToken($token)->post('notify.eskiz.uz/api/message/sms/send', [
                'mobile_phone' => '998'.$number,
                'message' => 'Tasdiqlash kodi - '.$value,
                'from' => '4546',
                'callback_url' => 'http://0000.uz/test.php'
            ]);

            Session::put('phone',$number);
            Session::put('code',$value);
            Session::put('phone_etap',200);
            return [
                'status' => 200,
                'code' => $value,
            ];
        }
    }

    public function codeEtap(Request $request)
    {
        if(intval(Session::get('code')) == intval($request->code))
        {
            Session::put('code_etap',200);

            return [
                'status' => 200,
                'number' => Session::get('phone'),

            ];
        }else{
            return [
                'status' => 300
            ];
        }
        
    }
    public function parolEtap(Request $request)
    {
        Session::put('password',$request->password);
        Session::put('parol_etap',200);

        return [
            'status' => 200,
        ];
        
    }
    public function mapEtap(Request $request)
    {
        $user = User::create([
            'first_name' => Session::get('first_name'),
            'last_name' => Session::get('last_name'),
            'birth_date' => Session::get('year').'-'.Session::get('month').'-'.Session::get('day'),
            'phone_number' => Session::get('phone'),
            'password' => Hash::make(Session::get('password')),
            'pass' => Session::get('password'),
            'lat' => $request->lat,
            'long' => $request->long,
            'pharmacy' => $request->pharmacy,
        ]);
        if($user)
        {
            Session::put('user',$user);
            return [
                'status' => 200,
            ];
        }else{
            return [
                'status' => 300,
            ];

        }
    }
    public function login(Request $request)
    {

        $request->validate([
            'password' => 'required|min:4',
        ]);
        // return $request->password;

        $user = User::where('pass',$request->password)->first();

        if($user)
        {
            // Session::put('user',$user);
            Auth::login($user);
            // return route('home');
        }else{
            return redirect()->back();
        }
        // if ($password === "your-predefined-password") {
        //   $user = User::findOrFail(1); // The ID of the only user in the system

        //   Auth::login($user); // Log the user in

        //   // Redirect somewhere
        //   return redirect()->intended('dashboard');
        // }

        // // If the password didn't match, redirect back the the login page
        // return redirect('login')->with('error', 'Wrong password!');
    }
}
