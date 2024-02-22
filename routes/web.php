<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'Mikrotik\HomeController@index')->name('home');
Route::group(['namespace' => 'Mikrotik'], function () {
    Route::post('/auth', 'AuthController@login')->name('login.page');
    Route::get('/logout', 'AuthController@logout')->name('logout');

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/graf/{interfaceName}', 'InterfaceController@graf')->name('graf');
    Route::post('/system/reset', 'HomeController@reset')->name('reset');
    Route::post('/system/reboot', 'HomeController@reboot')->name('reboot');

    Route::get('pppoe/addserver', 'PPPoEController@show')->name('pppoe.server');
    Route::post('pppoe/addserver', 'PPPoEController@addserver')->name('add.server');
    Route::get('pppoe/dellserver/{id}', 'PPPoEController@delserver')->name('delserver');
    Route::get('pppoe/profile', 'PPPoEController@profile')->name('pppoe.profile');
    Route::post('pppoe/profile', 'PPPoEController@addprofile')->name('add.profile.pppoe');
    Route::get('pppoe/dellprofile/{id}', 'PPPoEController@dellprofile')->name('dellprofile');
    Route::get('pppoe/secret', 'PPPoEController@secret')->name('secret.pppoe');
    Route::post('pppoe/secret', 'PPPoEController@addsecret')->name('add.secret');
    Route::post('toggle', 'PPPoEController@toggleSecret')->name('pppoe.secret.toggle');
    Route::get('pppoe/dellsecret/{id}', 'PPPoEController@dellsecret')->name('dellsecret');
    Route::get('pppoe/active', 'PPPoEController@active')->name('active.pppoe');
    Route::get('pppoe/dellactive/{id}', 'PPPoEController@dellactive')->name('dellactive');

    Route::get('setting/ping', 'SettingController@show')->name('show');
    Route::post('setting/ping', 'SettingController@ping')->name('ping');

    Route::get('setting/isolir', 'SettingController@isolir')->name('isolir');
});

