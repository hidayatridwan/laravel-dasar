<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response("Hello Response");
    }

    public function header(Request $request): Response
    {
        $body = [
            'firstName' => 'Ridwan',
            'lastName' => 'Hidayat'
        ];

        return response(json_encode($body), 200, [
            'Content-Type' => 'application/json',
            'Author' => 'Ridwan Hidayat',
            'Key' => '123'
        ]);
    }

    public function responseView(Request $request): Response
    {
        return response()
            ->view('hello', ['name' => 'Ridwan Hidayat']);
    }

    public function responseJson(Request $request): JsonResponse
    {
        return response()
            ->json(['name' => 'Ridwan Hidayat', 'age' => 30]);
    }

    public function responseFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app\public\pictures\ridwan.png'));
    }

    public function responseDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app\public\pictures\ridwan.png'));
    }
}
