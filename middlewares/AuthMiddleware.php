<?php

namespace thecodeholicc\phpmvcc\middlewares;

use thecodeholicc\phpmvcc\Application;
use thecodeholicc\phpmvcc\exeption\ForbiddenExeption;

class AuthMiddleware extends BaseMiddleware
{
public array  $actions=[];

    public function __construct(array $actions=[])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if(Application::isquest())
        {
            if(empty($this->actions) || in_array(Application::$app->controller->action,$this->actions))
            {
                    throw new ForbiddenExeption();
            }
        }
    }
}