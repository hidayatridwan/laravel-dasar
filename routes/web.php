<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello/{name}', [HelloController::class, 'hello']);
Route::get('/request/{name}', [HelloController::class, 'request']);

Route::controller(InputController::class)->group(function () {
    Route::get('/input', 'hello');
    Route::post('/input', 'hello');
    Route::post('/input/first', 'helloFirst');
    Route::post('/input/hello', 'helloInput');
    Route::post('/input/array', 'helloArray');
    Route::post('/input/type', 'inputType');
});

Route::post('/input/filter/only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExcept']);

Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware(VerifyCsrfToken::class);

Route::prefix('/response/type')->controller(ResponseController::class)->group(function () {
    Route::get('/hello', 'response');
    Route::get('/header', 'header');
    Route::get('/view', 'responseView');
    Route::get('/json', 'responseJson');
    Route::get('/file', 'responseFile');
    Route::get('/download', 'responseDownload');
});

Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);

Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);
Route::get('/redirect/domain', [RedirectController::class, 'redirectDomain']);
Route::get('/redirect/named', function () {
    // return route('redirect-hello', ['name' => 'Ridwan']);
    // return url()->route('redirect-hello', ['name' => 'Ridwan']);
    return URL::route('redirect-hello', ['name' => 'Ridwan']);
});

Route::middleware('contoh:PZN,401')->group(function () {
    Route::get('middleware/api', function () {
        return "OK";
    });
    Route::get('middleware/group', function () {
        return "GROUP";
    });
});

Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'formSubmit']);

Route::get('/url/current', function () {
    return URL::full();
});

Route::get('/session/create', [SessionController::class, 'createSession']);

Route::get('/error/sample', function () {
    throw new Exception('Sample error');
});
Route::get('/error/manual', function () {
    report(new Exception('Sample error'));
    return "OK";
});
Route::get('/error/validation', function () {
    throw new ValidationException('Sample error validation');
});

Route::get('/abort/400', function () {
    abort(400, 'Ups validasi salah');
});

Route::get('/abort/401', function () {
    abort(401);
});

Route::get('/abort/500', function () {
    abort(500);
});
