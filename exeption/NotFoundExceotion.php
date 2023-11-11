<?php

namespace app\core\exeption;

class NotFoundExceotion extends \Exception
{
    protected $message='sorry the page not Found';
    protected  $code=404;
}