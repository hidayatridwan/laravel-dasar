<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request)
    {
        $request->session()->put('username', 'ridwan');
        $request->session()->put('isMember', true);

        return "OK";
    }
}
