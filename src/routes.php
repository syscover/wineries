<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can any all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['middleware' => ['web', 'pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | WINERIES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/wineries/wineries/{lang}/{offset?}',                                    ['as' => 'winery',                    'uses' => 'Syscover\Wineries\Controllers\WineryController@index',                      'resource' => 'wineries-winery',        'action' => 'access']);
    Route::any(config('pulsar.appName') . '/wineries/wineries/json/data/{lang}',                                    ['as' => 'jsonDataWinery',            'uses' => 'Syscover\Wineries\Controllers\WineryController@jsonData',                   'resource' => 'wineries-winery',        'action' => 'access']);
    Route::get(config('pulsar.appName') . '/wineries/wineries/create/{lang}/{offset}/{tab}/{id?}',                  ['as' => 'createWinery',              'uses' => 'Syscover\Wineries\Controllers\WineryController@createRecord',               'resource' => 'wineries-winery',        'action' => 'create']);
    Route::post(config('pulsar.appName') . '/wineries/wineries/store/{lang}/{offset}/{tab}/{id?}',                  ['as' => 'storeWinery',               'uses' => 'Syscover\Wineries\Controllers\WineryController@storeRecord',                'resource' => 'wineries-winery',        'action' => 'create']);
    Route::get(config('pulsar.appName') . '/wineries/wineries/{id}/edit/{lang}/{offset}/{tab}',                     ['as' => 'editWinery',                'uses' => 'Syscover\Wineries\Controllers\WineryController@editRecord',                 'resource' => 'wineries-winery',        'action' => 'access']);
    Route::put(config('pulsar.appName') . '/wineries/wineries/update/{lang}/{id}/{offset}/{tab}',                   ['as' => 'updateWinery',              'uses' => 'Syscover\Wineries\Controllers\WineryController@updateRecord',               'resource' => 'wineries-winery',        'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/wineries/wineries/delete/{lang}/{id}/{offset}',                         ['as' => 'deleteWinery',              'uses' => 'Syscover\Wineries\Controllers\WineryController@deleteRecord',               'resource' => 'wineries-winery',        'action' => 'delete']);
    Route::get(config('pulsar.appName') . '/wineries/wineries/delete/translation/{lang}/{id}/{offset}',             ['as' => 'deleteTranslationWinery',   'uses' => 'Syscover\Wineries\Controllers\WineryController@deleteTranslationRecord',    'resource' => 'wineries-winery',        'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/wineries/wineries/delete/select/records/{lang}',                     ['as' => 'deleteSelectWinery',        'uses' => 'Syscover\Wineries\Controllers\WineryController@deleteRecordsSelect',        'resource' => 'wineries-winery',        'action' => 'delete']);
    Route::post(config('pulsar.appName') . '/wineries/wineries/check/hotel/slug',                                   ['as' => 'apiCheckSlugWinery',        'uses' => 'Syscover\Wineries\Controllers\WineryController@apiCheckSlug',               'resource' => 'wineries-winery',        'action' => 'access']);
});