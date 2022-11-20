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
    $sensor = \App\Models\Sensor::where('serial_number',$data['uuid'])->first();
    $new_measurement = new \App\Models\Measurement();
    if($new_measurement){
        $new_measurement->sensor_id = $sensor->id;
        $new_measurement->irrigation = bindec($b[0]);
        $new_measurement->save();
    }
    die();
});
