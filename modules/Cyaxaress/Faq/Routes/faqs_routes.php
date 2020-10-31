<?php

Route::group(["namespace" => "Cyaxaress\Faq\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('faqs', 'FaqController');
    $router->patch('faqs/{id}/change-status', 'FaqController@changeStatus')->name('faqs.changeStatus');

});
