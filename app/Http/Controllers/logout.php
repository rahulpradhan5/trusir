<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class logout extends Controller
{
    //
    public function logout()
    {
        Session()->forget('mobile');
        Session()->forget('role');
        Session()->forget('isStudent');
        Session()->forget('user_id');
        return redirect('/Login');
    }
}
