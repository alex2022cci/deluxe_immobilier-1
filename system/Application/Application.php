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
            // // Configuration du lancement du site
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