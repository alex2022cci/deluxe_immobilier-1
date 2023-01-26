<?php

    namespace System\Router\Web;

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

            //Je vais ajouter dans mon tableau la route qu'il doit prendre
            array_push($routes['get'], array(
                'url' => trim($url, "/ "),
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
                'url' => trim($url, "/ "),
                'class' => $class,
                'method' => $method,
                'name' => $name
            ));
            
        }

        public static function delete($url, $executeMethod, $name = null)
        {
            // je vais decouper l'execution de ma method
            $executeMethod = explode('@', $executeMethod);

            // Je vais rechercher ma class et ma method 
            $class = $executeMethod[0];
            $method = $executeMethod[1];

            // Pour eviter les warning
            global $routes;

            // Je vais ajouter ma nouvelle route
            array_push($routes['delete'], array(
                'url' => trim($url, "/ "),
                'class' => $class,
                'method' => $method,
                'name' => $name
            ));
        }

        public static function put($url, $executeMethod, $name = null)
        {
            // je vais decouper l'execution de ma method
            $executeMethod = explode('@', $executeMethod);

            // Je vais rechercher ma class et ma method 
            $class = $executeMethod[0];
            $method = $executeMethod[1];

            // Pour eviter les warning
            global $routes;

            // Je vais ajouter ma nouvelle route
            array_push($routes['put'], array(
                'url' => trim($url, "/ "),
                'class' => $class,
                'method' => $method,
                'name' => $name
            ));
        }
    }

    // Seconde facon d'écrire pour eviter de dupliquer son code, c'est de créer un constructor

    /*
     * public fontion __construct($url, $executeMethod, $name = null)
     *  $executeMethod = explode('@', $executeMethod);

            // Je vais rechercher ma class et ma method 
            $this->class = $executeMethod[0];
            $this->method = $executeMethod[1];

            // Pour eviter les warning
            global $routes;

            array_push($routes['put'], array(
                'url' => trim($url, "/ "),
                'class' => $class,
                'method' => $method,
                'name' => $name
            ));
*/