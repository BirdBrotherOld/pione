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

$ru_prefix = '/emails/myedu/';
Route::get($ru_prefix . 'email-sample', function () {
    // Mail::to('muchamad.arvan26@gmail.com')
    //     ->send(new App\Mail\StudentInterviewReminderDaily([
    //         'student_name' => 'Muchamad Arvan',
    //         'interviews_link' => 'https://myedusolve.com/',
    //     ]));
    return new App\Mail\MembershipRegisterNotification([
        'email' => 'muchamad.arvan27@gmail.com',
        // 'candidates_name' => 'Muchamad Arvan',
        // 'company_email' => 'invisioncompany@yopmail.com',
        // 'company_address' => 'complete Address',
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('data', 'ProductController@get');
Route::get('membership', 'HomeController@membership');
