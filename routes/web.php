<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', ['as' => 'challenge.index', 'uses' => 'ChallengeController@index']);
$router->get('/renew-game', ['as' => 'challenge.renew-game', 'uses' => 'ChallengeController@renewGame']);
$router->post('/sign-up', ['as' => 'challenge.sign-up', 'uses' => 'ChallengeController@signUp']);
$router->post('/guess-number', ['as' => 'challenge.guess-number', 'uses' => 'ChallengeController@guessNumber']);
