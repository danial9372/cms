<?php

Route::group(["namespace" => "Cyaxaress\Menu\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('Menus', 'MenuController');
    $router->patch('Menus/{id}/change-status', 'MenuController@changeStatus')->name('Menus.changeStatus');

});
