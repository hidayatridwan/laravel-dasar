<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {
        $name = $request->input('name');
        return "Hello $name";
    }

    public function helloFirst(Request $request): string
    {
        $name = $request->input('name.first');
        return "Hello $name";
    }

    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function helloArray(Request $request): string
    {
        $input = $request->input('students.*.first');
        return json_encode($input);
    }

    public function inputType(Request $request): string
    {
        $name = $request->input('name');
        $isMarried = $request->boolean('is_married');
        $birthDate = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            'name' => $name,
            'is_married' => $isMarried,
            'birth_date' => $birthDate,
        ]);
    }

    public function filterOnly(Request $request): string
    {
        $name = $request->only('name.first', 'name.last');

        return json_encode($name);
    }

    public function filterExcept(Request $request): string
    {
        $user = $request->except('admin');

        return json_encode($user);
    }
}
