<?php

namespace app\core;

use app\core\Controller;
use app\core\exeption\NotFoundExceotion;

class Router
{

    public Request $request;
    public Response $response;

    public function __construct(Request $request , Response $response)
    {
        $this->request =$request;
        $this->response =$response;

    }
    protected array $routes=[];
    public function get($path ,$callback)
    {
        $this->routes['get'][$path]=$callback;
    }
    public function post($path ,$callback)
    {
        $this->routes['post'][$path]=$callback;
    }
    
    
    public function resolve()
    {
       $path= $this->request->getPath();
       $method = $this->request->method();
       $callback=$this->routes[$method][$path] ?? false;
       if($callback === false)
       {
        throw new NotFoundExceotion();
       }
       if(is_string($callback))
       {
            return Application::$app->view->renderView($callback);
       }
       if(is_array($callback))
       {
           /** @var \app\core\Controller $controller */
           $controller = new $callback[0]();
           Application::$app->controller=$controller;
           $controller->action=$callback[1];
           $callback[0]=$controller;

           foreach ($controller->getMiddlewares() as $middleware)
          {
              $middleware->execute();
          }
       }
       return call_user_func($callback,$this->request,$this->response);
       
    }

}