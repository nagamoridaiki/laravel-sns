<?php

use Illuminate\Http\Request;

Route::get('/messages', 'MessageController@index')->name('message.index');

