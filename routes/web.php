<?php

Route::get('/', 'HomeController@index');
Route::get('layers/{stack_id}/{filename}', 'LayerController@layerImage');
