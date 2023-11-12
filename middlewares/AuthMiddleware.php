<?php

namespace thecodeholic\phpmvc\middlewares;

use thecodeholic\phpmvc\Application;
use thecodeholic\phpmvc\exeption\ForbiddenExeption;

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