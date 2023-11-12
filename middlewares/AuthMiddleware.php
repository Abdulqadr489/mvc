<?php

namespace thephp\phpmvccore\middlewares;

use thephp\phpmvccore\Application;
use thephp\phpmvccore\exeption\ForbiddenExeption;

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