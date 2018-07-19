<?php

Auth::routes();

Route::get('/home', 'ThreadController@index')->name('home');
Route::get('/', 'ThreadController@index');
Route::get('threads', 'ThreadController@index');

Route::get('/threads/create', 'ThreadController@create');
Route::get('threads/{channel}', 'ThreadController@index');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::delete('/threads/{channel}/{thread}', 'ThreadController@destroy');
Route::post('/threads', 'ThreadController@store');

Route::get('replies/{reply}/favorites', 'FavoriteController@store');
Route::delete('replies/{reply}/favorites', 'FavoriteController@destroy');

Route::get('/threads/{channel}/{thread}/replies', 'ReplyController@index');
Route::delete('/replies/{reply}', 'ReplyController@destroy');
Route::patch('/replies/{reply}', 'ReplyController@update');
Route::post('/threads/{channel}/{thread}/reply', 'ReplyController@store');

Route::post('/threads/{channel}/{thread}/subcriptions', 'ThreadSubscriptionController@store')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subcriptions', 'ThreadSubscriptionController@destroy')->middleware('auth');

Route::get('profiles/{profileUser}', 'ProfileController@index');
Route::get('/profiles/{user}/notifications', 'UserNotificationController@index');
Route::delete('profiles/{user}/notifications/{notification}', 'UserNotificationController@destroy');

