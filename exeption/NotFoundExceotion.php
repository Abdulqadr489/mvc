<?php

namespace thephp\phpmvccore\exeption;

class NotFoundExceotion extends \Exception
{
    protected $message='sorry the page not Found';
    protected  $code=404;
}