<?php

    namespace System\Application;

    class Application
    {
        // Ecriture des constructeurs
        public function __construct()
        {
            $this->loadProviders();
            $this->loadHelpers();
            $this->registerRoutes();
            $this->routing();
        }

        // Ecrire une fonction privé qui ne seront pas disponible pour le public
        private function loadProviders()
        {
            // Configuration du lancement du site
            // $appConfigs = require dirname(dirname(__DIR__)) . "/config/app.php";
            // $providers = $appConfigs['providers'];
            // foreach ($providers as $provider)
            // {
            //     $providerObject = new $provider();
            //     $providerObject->boot();
            // }

        }
        // Generer nos routes
        private function loadHelpers()
        {
            // Permet de faire de l'affichage en HTML
            require_once(dirname(__DIR__) . '/helpers/helpers.php');

            // Pour trouver le fichier
            if(file_exists(dirname(dirname(__DIR__)) . '/App/Http/helpers.php'))
            {
                require_once(dirname(__DIR__) . '/helpers/helpers.php');
            }
        }
        // gestion des urls
        private function  registerRoutes()
        {
            global $routes;

            $routes = [
                'get' => [],
                'post' => [],
                'put' => [],
                'delete' => [] 
            ];

            require_once (dirname(dirname(__DIR__)) . '/routes/web.php');
            require_once (dirname(dirname(__DIR__)) . '/routes/api.php');
        }

        private function routing()
        {
            // Pour lancer le routing
            $routing = new \System\Router\Routing();

            $routing->run();

        }
    }

    