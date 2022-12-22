<?php

namespace App\Http\Controllers;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        // $agent = request()->header('user-agent');
        // $clientIP = $this->getIp();
        // return $clientIP;
        // $ip = '49.35.41.195'; //For  static IP address get
        // // $ip = request()->ip(); //Dynamic IP address get
        // // $ip = $_SERVER['REMOTE_ADDR'];
        // // $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        // $data = Location::get($ip);    
        // return $data;
        // $ipAddresses = $this->getClientIps();
        // $method2 = request()->getClientIp();
        // return $data;            
        // Session::flush();
        // return view('details',compact('data'));
        // if(Session::get('name_etap') && Session::get('date_etap') && Session::get('phone_etap') && Session::get('code_etap') && Session::get('parol_etap') && Session::get('map_etap'))
        // {
        //     User::create([
        //         'first_name' => Session::get('name_etap'),
        //         'last_name' => Session::get('last_name'),
        //         'birth_date' => Session::get('year').'-'.Session::get('month').'-'.Session::get('day'),
        //         'phone_number' => Session::get('phone'),
        //         'password' => Hash::make(Session::get('password')),
        //     ]);
        //     return view('user.index');
        // Session::flush();

        // return Session::get('user');
        if(!Session::has('user'))
        {
            return view('auth.login');
        }
        else{
            return view('home');
        }
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
