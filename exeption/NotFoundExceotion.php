<?php

namespace thecodeholicc\phpmvcc\exeption;

class NotFoundExceotion extends \Exception
{
    protected $message='sorry the page not Found';
    protected  $code=404;
}