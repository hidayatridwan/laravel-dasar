<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function createCookie(Request $request): Response
    {
        return response('Create Cookie')
            ->cookie('username', 'ridwan', 1000, '/')
            ->cookie('isMember', true, 1000, '/');
    }

    public function getCookie(Request $request): JsonResponse
    {
        return response()
            ->json([
                'username' => $request->cookie('username', 'guest'),
                'isMember' => $request->cookie('isMember', false)
            ]);
    }

    public function clearCookie(Request $request): Response
    {
        return response('Clear Cookie')
            ->withoutCookie('username')
            ->withoutCookie('isMember');
    }
}
