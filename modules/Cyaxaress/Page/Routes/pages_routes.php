<?php

Route::group(["namespace" => "Cyaxaress\Page\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('pages', 'PageController');
    $router->patch('pages/{id}/change-status', 'PageController@changeStatus')->name('pages.changeStatus');

});
