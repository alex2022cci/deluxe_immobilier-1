<?php 

function dd($value, $die = true)
{
    var_dump($value);
    if($die)
    exit;
}

function view($dir, $vars = [])
{
    $viewBuilder =  new \System\View\viewBuilder();
    $viewBuilder->run($dir);
    $viewVars = $viewBuilder->vars;
    $content = $viewBuilder->content;

    // Pour extraire les varirables de la vue 
    empty($viewVars)? :extract($viewVars);
    empty($vars)? :extract($vars);

    // On va utiliser une fonction de php pour garder l'HTML et qui permet de lancer du code PHP
    eval("?>".html_entity_decode($content));
 }

 function html($text)
 {
    return html_entity_decode($text);
 }

 function old($name)
 {
    // on va voir si notre session temporaire est sur true ou false
    if(isset($_SESSION['temporary_old'][$name]))
    {
        return $_SESSION['temporary_old'][$name];
    }
    else
    {
        return null;
    }
 }

 function flashExist($name)
 {
    // Pour afficher des données en cas d'erreur
    return isset($_SESSION['temporary_flash'][$name]) === true ? true : false;
 }

 function allFlashes()
 {
    if(isset($_SESSION['temporary_flash']))
    {
        $temporary = $_SESSION['temporary_flash'];
        unset($_SESSION['temporary_flash']);
        return $temporary;
    }
    else
    {
        return false;
    }
 }

 function error($name, $message = null)
 {
    if(empty($message))
    {
        if(isset($_SESSION['temporary_errorflash']))
        {
            $temporary = $_SESSION['temporary_errorflash'];
            unset($_SESSION['temporary_errorflash']);
            return $temporary;
        }
        else
        {
            return false;
        }
    }
    else
    {
        $_SESSION['errorFlash'][$name] = $message;
    }
 }

 function errorExists($name = null)
 {
    if($name === null)
    {
        // Compter le nombre d'erreur dans mon tableau
        return isset($_SESSION['temporary_errorflash']) === true ? count($_SESSION['temporary_errorflash']) : false;
    }
    else
    {
        // Si tout est vrai ça me retourne vide
        return isset($_SESSION['temporary_errorflash']) === true ? true : false;
    }
 }

 function allErrors()
 {
    if(isset($_SESSION['temporary_errorflash']))
    {
        $temporary = $_SESSION['temporary_errorflash'];
        unset($_SESSION['temporary_errorflash']);
        return $temporary;
    }
    else
    {
        return false;
    }
 }

 function currentDomain()
 {
    $httpProtocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
    $currentUrl = $_SERVER['HTTP_HOST'];
    
    // Je dois retourner le protocole http ou https + le nom de domaine 
    //Exemple https://localhost
    return $httpProtocol . $currentUrl;

 }

 function redirect($url)
 {
    $url = trim($url, '/ ');
    $url = strpos($url, currentDomain()) === 0 ? $url :currentDomain().'/'. $url;
    header("Location: " . $url);
    exit;
 }

 function back()
 {
    // retourner à la page précédente
    $http_referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
    redirect($http_referer);
 }

 function asset($src)
 {
    //Cherche aller chercher nos sources tous nos fichiers et script
    return currentDomain().("/".trim($src, "/ "));
 }

 function url($url)
 {
    // On va aller chercher nos url
    return currentDomain().("/".trim($url, "/ "));
 }

 function findRouteByName($name)
 {
    // Pour aller chercher les routes par le nom
    global $routes;

    // On va mettre dans un tableau toutes nos routes
    $allRoutes = array_merge($routes['get'], $routes['post'], $routes['put'], $routes['delete']);
    
    $routes = null;
    foreach($allRoutes as $element)
    {
        //On va mettre une condition de verification
        if($element['name'] == $name && $element['name'] !== null)
        {
            $routes = $element['url'];
            break;
        }
    }
    return $routes;
 }
 
 function routes($name, $params = [] )
 {
    // Pour aller chercher les parametres apres le nom de domaine (ce qui est après le ? )
    if(!is_array($params))
    {
        // On va se mettre une exception
        throw new \Exception("Les parametres dans la route ne sont pas dans notre tableau");
    }
    $routes = findRouteByName($name);
    if($routes === null)
    {
        throw new \Exception("La route n'est pas trouvé : 404");
    }
    $params = array_reverse($params);
    $routesParamsMatch = [];
    
    // Pour aller check les parametres qui sont dans ma route
    preg_match_all("/{[^}.]*}/", $routes, $routesParamsMatch);

    // On va aller verifiser si le nombre de parametre coincide avec les parametres url et attendu
    if(count($routesParamsMatch[0]) > count($params))
    {
        throw new \Exception("Les paramètres  ne sont pas bons");
    }
    foreach($routesParamsMatch[0] as $key => $routesMatch)
    {
        $routes = str_replace($routesMatch, array_pop($params), $routes);
    }
    return currentDomain() . "/" . trim($routes, " /");
 }

 function generateToken()
 {
    return bin2hex(openssl_random_pseudo_bytes(32));
 }

 function methodField()
 {
    $method_field = strtolower($_SERVER['REQUEST_METHOD']);

    if($method_field == 'post'){

        if(isset($_POST['_method'])){

            if($_POST['_method'] == 'put'){
                $method_field = 'put';
            }
            elseif($_POST['_method'] == 'delete'){
                $method_field = 'delete';
            }
        }

    }
    return $method_field;
 }

 function array_dot($array, $return_array = [], $return_key = [])
 {
    if(is_array($value))
    {
        $return_array = array_merge($return_array,
                        array_dot($value, $return_array, $return_key . $key . '.'));
    }
    else{
        $return_array[$return_key . $key] = $value;
    }
 }

 function currentUrl()
 {
    return currentDomain() . $_SERVER['REQUEST_URI'];
 }