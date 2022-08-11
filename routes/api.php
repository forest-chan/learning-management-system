<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

const JSON_QUERY = '{"actor": {"name": "Иван Иванов","mbox": "mailto:ivanov@mail.ru" }, "verb": { "id": "http://adlnet.gov/expapi/verbs/attempted", "display": { "en-US": "attempted" } }, "object": { "id": "http://mylms.com/activities/course1", "definition": { "name": { "en-US": "Курс 1" } } } }';
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

//todo api/test-show-all-statements <--- не забудь добавить 'api' в url

Route::get('test-show-10-statement', function (){
    $response = Http::withHeaders([
        'Authorization' => '$2y$10$riK8NR.xNdyotQLhkMAWz.NZ78En2a.YTjhFBsPr6jEcUxL.7CDcG',
    ])->get('http://127.0.0.1:8001/api/statements/10');
    $body = $response->body();
    var_dump(json_decode($body));
});

//todo api/test-show-all-statements <--- не забудь добавить 'api' в url
Route::get('test-show-all-statements', function (){
    $response = Http::withHeaders([
        'Authorization' => '$2y$10$riK8NR.xNdyotQLhkMAWz.NZ78En2a.YTjhFBsPr6jEcUxL.7CDcG',
    ])->get('http://127.0.0.1:8001/api/statements');
    $body = $response->body();
    var_dump(json_decode($body));
});

//todo api/test-show-all-statements <--- не забудь добавить 'api' в url

Route::get('test-create-new-statement-in-lrs', function (){
    $response = Http::withHeaders([
        'Authorization' => '$2y$10$riK8NR.xNdyotQLhkMAWz.NZ78En2a.YTjhFBsPr6jEcUxL.7CDcG',
    ])->withBody(JSON_QUERY, 'application/json')
        ->post('http://127.0.0.1:8001/api/statements');
    $body = $response->body();
    echo $body;
    var_dump($body);
});
