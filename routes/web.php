<?php 

    use System\Router\Web\Route;

    // Je vais créer toutes les url du front office
    Route::get('/', 'HomeController@index', 'home.index');
    Route::get('/search', 'HomeController@search', 'home.search');
    Route::get('/ads/{id}', 'HomeController@ads', 'home.ads');


    // Je créer tout mes appels ajax
    

    // Je créer mes url pour l'espace admin


    // Je créer mes url pour mes categories admins ( GET / POST / DELETE / PUT)


    // Je créer mes url pour le systeme d'authentification

