<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Redirect to";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect('redirect/to');
    }

    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    public function redirectName(): RedirectResponse
    {
        return redirect()
            ->route('redirect-hello', [
                'name' => 'Ridwan'
            ]);
    }

    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], [
            'name' => 'Ridwan'
        ]);
    }

    public function redirectDomain(): RedirectResponse
    {
        return redirect()->away('https://google.com');
    }
}
