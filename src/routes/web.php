<?php

// ROUTES
Route::prefix('abonews')->group(function () {

  Route::prefix('subscribers')->group(function () {
    route::get('/list', 'AbonewsController@subscriber_list');
    route::post('/add', 'AbonewsController@subscriber_add');
    route::post('/remove', 'AbonewsController@subscriber_rm');
  });

  Route::prefix('email')->group(function () {
    route::post('/prepare', 'AbonewsController@prepare_send');
    route::get('/sender', 'AbonewsController@task_send');
  });

});
