<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiBattleController extends Controller
{
    public function getProvizor(Request $request)
    {
        $get_pros = User::whereIn('region_id',$request['regions'])->get();
        return [
            'provizors' => $get_pros
        ];
    }
}
