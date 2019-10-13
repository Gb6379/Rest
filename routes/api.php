<?php

use Illuminate\Http\Request;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    
    return $request->user();
    
});


    Route::get('/tasks', 'TaskController@index')->name('task');
    Route::get('/tasks/{id}', 'TaskController@show')->name('task.show');
    Route::post('/tasks/new', 'TaskController@store')->name('task.store');
    Route::put('/tasks/{id}/update', 'TaskController@update')->name('task.update');
    Route::put('/tasks/{id}/completed', 'TaskController@completeTask')->name('task.status');
    Route::put('/tasks/{id}/uncompleted', 'TaskController@uncompleteTask')->name('task.statusu');
    Route::delete('/tasks/{id}/delete', 'TaskController@destroy')->name('task.destroy');
    Route::get('/tasks/fileter/{from}/{to}', 'DateRangeController@index')->name('daterange');



/*Route::prefix('tasks')->group(function(){
        Route::get('/', 'TaskController@index')->name('task');
        Route::get('/{id}', 'TaskController@show')->name('task.show');
        
        //Route::get('/tasks/new', 'TaskController@create')->name('task.create');
        //Route::get('/tasks/{id}/edit', 'TaskController@edit')->name('task.edit');
        Route::post('/tasks/new', 'TaskController@store')->name('task.store');
        Route::put('/tasks/{id}/update', 'TaskController@update')->name('task.update');
        Route::put('/tasks/{id}/completed', 'TaskController@completeTask')->name('task.status');//mark a task as completed
        Route::put('/tasks/{id}/uncompleted', 'TaskController@uncompleteTask')->name('task.statusu');//unmark it
        Route::delete('/tasks/{id}/delete', 'TaskController@destroy')->name('task.destroy');
        Route::get('/tasks/fileter', 'DateRangeController@index')->name('daterange');//daterange filter

});*/

