<?php

namespace thecodeholicc\phpmvcc\exeption;

class ForbiddenExeption extends \Exception
{
    protected $message='You Don\'t have permission to access this page';
    protected  $code=403;

}