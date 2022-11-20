<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/update/sensor', function (Request $request) {
    $data = $request->json()->all();
    $a = base64_decode($data['payload']);
    $b = array();
    foreach(str_split($a) as $c)
        $b[] = sprintf("%08b", ord($c));
    print_r([$data['uuid'],bindec($b[0])]);
    die();
});
