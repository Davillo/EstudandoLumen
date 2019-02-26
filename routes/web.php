<?php


$router->get('/api/cars','CarsController@getAll');

$router->group(['prefix'=>'/api/car'], function() use ($router){
    $router->get('/{id}','CarsController@getOne');
    $router->post('/','CarsController@store');
    $router->put('/{id}','CarsController@update');
    $router->delete('/{id}','CarsController@destroy');
});

