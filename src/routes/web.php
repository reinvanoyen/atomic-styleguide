<?php

Route::namespace('ReinVanOyen\AtomicStyleguide\Controllers')
    ->prefix('styleguide')
    ->group(function() {

        Route::get('/', 'StyleguideController@index')->name('styleguide.index');
        Route::get('/{type}', 'StyleguideController@type')->name('styleguide.type');
        Route::get('/{type}/{component}', 'StyleguideController@component')->name('styleguide.component');
});