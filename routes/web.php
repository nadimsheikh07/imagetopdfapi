<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/sendmail',function (){
    dump(env('MAIL_FROM_ADDRESS'));
    try{
        $mail=\Illuminate\Support\Facades\Mail::to('bhavya@yopmail.com')->send(new \App\Mail\TestMail());
        dd('Sent',$mail);
    }catch (Exception $er){
        dd($er);
    };
//   $mail=\Illuminate\Support\Facades\Mail::send(new \App\Mail\TestMail());
//
//   if($mail)
//   {
//       dd('mail sent');
//   }else
//       dd('mail not sent');
});
