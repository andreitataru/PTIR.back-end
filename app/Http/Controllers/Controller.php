<?php

namespace App\Http\Controllers;
 //import auth facades
 use Illuminate\Support\Facades\Auth;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    
    //Add this method to the Controller class
    protected function respondWithToken($token, $firstTime)
    {
        return response()->json([
            'token' => $token,
            'firstTime' => $firstTime,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }

}
