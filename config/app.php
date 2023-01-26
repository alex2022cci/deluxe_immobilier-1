<?php
    // Je vais retourner la direction d'app dans un tableau
    return [
        
        // En associant dans le tableau 
        // Je vais faire la relation entre ma base de donnée et l'application
        // Je défini le nom de mes objtets à une valeur
        'APP_TITLE' => 'DELUXE IMMOBILIER',
        'BASE_URL' => 'http://localhost:8000',
        'BASE_DIR' => dirname(__DIR__),

        // Je vais retourner  dans un tableau  fournisseur Providers
        'providers' => [
            \App\Providers\SessionProvider::class,
            \App\Providers\AppServiceProvider::class,
        ]
    ];