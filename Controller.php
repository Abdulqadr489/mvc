<?php
namespace thecodeholicc\phpmvcc;
use thecodeholicc\phpmvcc\Application;
use thecodeholicc\phpmvcc\middlewares\AuthMiddleware;
use thecodeholicc\phpmvcc\middlewares\BaseMiddleware;
class Controller extends AuthMiddleware
{
        public string $layout='main';
        public  string  $action='';
        protected  array  $middlewares=[];
    public function setLayout($layout)
    {
         $this->layout=$layout;
    }
    public function Render($view,$params=[])
    {
        return Application::$app->view->renderView($view,$params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[]=$middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

}
