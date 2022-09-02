<?php

use App\Courses\Controllers\StatementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Courses Routes
|--------------------------------------------------------------------------
|
| Here is where you can register courses routes for your application.
|
*/

Route::post('send-launched/{course_id}/{section_id}', [StatementController::class, 'sendLaunchCourseStatement'])
    ->where('course_id', '[0-9]+')
    ->where('section_id', '[0-9]+')
    ->name('send.launched.statement');

Route::post('send-passed/{course_id}/{section_id}', [StatementController::class, 'sendPassCourseStatement'])
    ->where('course_id', '[0-9]+')
    ->where('section_id', '[0-9]+')
    ->name('send.passed.statement');

Route::get('get-course/{course_id}', [StatementController::class, 'getCourseStatements'])
    ->where('course_id', '[0-9]+')
    ->name('get.course');

Route::get('send-pull/{course_id}', [StatementController::class, 'sendPullCourseStatements'])
    ->where('course_id', '[0-9]+')
    ->name('send.pull.statements');

Route::post('send-passed/{course_id}', [StatementController::class, 'sendPassedCourseStatements'])
    ->where('course_id', '[0-9]+')
    ->name('send.passed.course.statements');

Route::get('/get-test', function () {
    $lrs = new TinCan\RemoteLRS();
    $lrs->setEndpoint('http://127.0.0.1:8001/api/xAPI');
    $token = ['Authorization' => config('services.lrs.token')];
    $lrs->setHeaders($token);

    $verb = new TinCan\Verb(
        ['id' => 'http://adlnet.gov/expapi/verbs/passed']
    );
    $response = $lrs->queryStatements([
        'verb' => $verb,
    ]);
    $responseString = $response->httpResponse["_content"];
    dd(json_decode($responseString));

});


