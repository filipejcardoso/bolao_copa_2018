<?php

use Illuminate\Http\Request;

Route::get('/acess', ['uses' => 'JogosController@index']);
Route::group(['prefix' =>'eletrobidu'],function()
{
	Route::group(['prefix' =>'participantes'],function()
	{
		Route::get('', ['uses' => 'ParticipantesController@index']);
		Route::get('{id}', ['uses' => 'ParticipantesController@show']);
		// Route::post('', ['uses' => 'ParticipantesController@store']);
		// Route::patch('{id}', ['uses' => 'ParticipantesController@update']);
		// Route::delete('{id}', ['uses' => 'ParticipantesController@destroy']);
		
		Route::group(['prefix' =>'/{participantes}/apostas'],function()
		{
			Route::get('', ['uses' => 'ApostasController@index']);
			// Route::patch('{id}', ['uses' => 'ApostasController@update']);
		});
	});

	Route::group(['prefix' =>'/jogos'],function()
	{
		Route::get('', ['uses' => 'JogosController@index']);
		Route::patch('{id}', ['uses' => 'JogosController@update']);
	});
});

