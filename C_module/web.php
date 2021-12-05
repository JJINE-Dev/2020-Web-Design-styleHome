<?php

use App\Router;

// main
Router::get("/", "MainController@index");
// store
Router::get("/store", "MainController@store");

// user 

if(user()){
    // online
    Router::get('/houses', 'MainController@houses');
    Router::get('/house/grade/{idx}/{grade}', 'InsertController@grade');

    // specia
    Router::get('/specia', 'MainController@specia');
    // quote
    Router::get('/quote', 'MainController@quote');
    Router::get('/quote/{idx}', 'MainController@resp_quote');

    Router::get('/quote/update/{idx}', 'UpdateController@quote');

    // logout
    Router::get('/user/logout', 'UserController@logout');
} else {
    Router::get('/user/register', 'MainController@register');
    Router::get('/user/login', 'MainController@login');
}

Router::get('/captcha', 'MainController@captcha');

Router::post('/user/register', 'UserController@register');
Router::post('/user/login', 'UserController@login');

Router::post('/house/insert', 'InsertController@house');
Router::post('/review/insert', 'InsertController@review');
Router::post('/req_quote/insert', 'InsertController@req_quote');
Router::post('/resp_quote/insert', 'InsertController@resp_quote');

App\Router::route();