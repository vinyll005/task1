<?php

class Router
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    protected function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim(htmlentities($_SERVER['REQUEST_URI']), '/');
        }
    }
    
    public function run()
    {

        $uri = $this->getURI();
        foreach($this->routes as $pattern => $path)
        {
            if(preg_match("~^$pattern$~", $uri))  {
                $truePath = preg_replace("~^$pattern$~", $path, $uri);

                $params = explode('/', $truePath);

                $controllerName = ucfirst(array_shift($params)).'Controller';
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                $methodName = 'action'.ucfirst(array_shift($params));

                if(file_exists($controllerFile))    {
                    $controllerObject = new $controllerName;
                    call_user_func_array(array($controllerObject, $methodName), $params);
                }
            }
        }
    }
}

?>