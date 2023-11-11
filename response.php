<?php
namespace app\core;


class response{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect($url)
    {
        header('Location: '.$url);
    }


}
