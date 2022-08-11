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


Route::get('lrsTest', function (){
    $req = new \Illuminate\Http\Response();
    $req->header('Authorization', '$2y$10$riK8NR.xNdyotQLhkMAWz.NZ78En2a.YTjhFBsPr6jEcUxL.7CDcG');
    $response = \Illuminate\Support\Facades\Http::withHeaders([
        'Authorization' => '$2y$10$riK8NR.xNdyotQLhkMAWz.NZ78En2a.YTjhFBsPr6jEcUxL.7CDcG',
        'X-Second' => 'bar'
    ])->post('http://127.0.0.1:8001/api/statements/10', [
        'name' => 'Taylor',
    ]);
    $body = $response->body();

    dd(json_decode($body));


    $lrsResponse = \Illuminate\Support\Facades\Http::get('http://127.0.0.1:8001/api/statements');
    echo $lrsResponse;
});
