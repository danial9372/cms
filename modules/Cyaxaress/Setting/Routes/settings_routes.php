<?php

Route::group(["namespace" => "Cyaxaress\Setting\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('settings', 'SettingController');

});
