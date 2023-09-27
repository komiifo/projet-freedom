<?php 

class Router
{
    private $routes, $uri;

    public function __construct()
    {
        $routesPath = $_SERVER['DOCUMENT_ROOT'].'/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        $uri = '';

        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = $_SERVER['REQUEST_URI'];
        }

        if (($cutoff = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $cutoff);
        }
        return strlen($uri) > 1 ? trim($uri, '/') : $uri;
        
    }

     public function run()
    {
        $uri = $this->getURI();

        $internaluri = preg_replace('!\d+!', '',$uri);
        
        foreach ($this->routes as $uriPattern => $path) {

            if($internaluri == trim($uriPattern,'{$1}'))
            {

                //Chaine de recherche pour les noms de controller
                $segments = explode('/', $path);
                $controllerName = ucfirst($segments[0]);
                //action
                $actionName = $segments[1];

                $controllerFile = $_SERVER['DOCUMENT_ROOT'] . '/public/controllers/' .$controllerName. '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;

                //On cherche les paramètres dans l'URL  
               preg_match_all('!\d+!', $uri, $parameters);

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }

            }

          
        }
    }

}
