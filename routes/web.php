<?php

Route::get('/', 'PagesController@index')->name('home');
Route::get('/login', 'PagesController@index')->name('home');
Route::get('/members', 'PagesController@members');
Route::get('/groups', 'PagesController@groups');

Route::get('/register', 'RegistrationController@create')->middleware('guest');
Route::post('/register', 'RegistrationController@store');

Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/profile/{user}', 'UserController@show');
Route::post('/profile/{id}', 'UserController@storeProfileInfo')->middleware('auth');
Route::put('/profile/edit/{id}', 'UserController@editProfileInfo')->middleware('auth');

Route::get('/profile/{user}/wall-posts', 'UserController@showWallPosts')->middleware('auth');
Route::get('/profile/{user}/messages', 'UserController@showMessages')->middleware('auth');

Route::post('/messages/{user}/send/{id}', 'UserController@postMessage');

Route::get('/user/{user}/request/{friend}', 'UserController@requestFriendship')->middleware('auth');
Route::get('/user/{user}/request/{friend}/accept', 'UserController@acceptFriendship')->middleware('auth');
Route::get('/user/{user}/request/{friend}/refuse', 'UserController@refuseFriendship')->middleware('auth');

Route::post('/post', 'PostController@store');
Route::get('/post/{post}/like', 'PostController@storeLike')->middleware('auth');
Route::get('/post/{post}/unlike', 'PostController@destroyLike')->middleware('auth');

Route::post('/post/{post}/comment', 'CommentController@store');

Route::get('/group/{group}/user/{user}', 'GroupController@storeUser')->middleware('auth');
Route::get('/group/{group}/user/{user}/leave', 'GroupController@destroyUser')->middleware('auth');
Route::get('/group/{group}/user/{user}/remove', 'GroupController@founderRemoveMember')->middleware('auth');
Route::get('/group/create', 'GroupController@create')->middleware('auth');
Route::get('/group/{group}', 'GroupController@show');
Route::post('/group/store', 'GroupController@store');
Route::get('/group/{group}/edit', 'GroupController@edit')->middleware('auth');
Route::get('/group/{group}/delete', 'GroupController@delete')->middleware('auth');
Route::post('/group/{group}/edit', 'GroupController@editGroup');
