<?php 

    namespace System\Router\Api;

    class Route
    {
        public static function get($url, $executeMethod, $name = null)
        {
            // je vais decouper l'execution de ma method
            $executeMethod = explode('@', $executeMethod);

            // Je vais rechercher ma class et ma method 
            $class = $executeMethod[0];
            $method = $executeMethod[1];

            // Pour eviter les warning
            global $routes;

            // Je vais ajouter ma nouvelle route
            array_push($routes['get'], array(
                'url' => 'api/' . trim($url, "/ "),
                'class' => $class,
                'method' => $method,
                'name' => $name
            ));

        }

        public static function post($url, $executeMethod, $name = null)
        {
            // je vais decouper l'execution de ma method
            $executeMethod = explode('@', $executeMethod);

            // Je vais rechercher ma class et ma method 
            $class = $executeMethod[0];
            $method = $executeMethod[1];

            // Pour eviter les warning
            global $routes;

            // Je vais ajouter ma nouvelle route
            array_push($routes['post'], array(
                'url' => 'api/' . trim($url, "/ "),
                'class' => $class,
                'method' => $method,
                'name' => $name
            ));
            
        }
    }