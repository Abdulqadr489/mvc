<?php

namespace thecodeholicc\phpmvcc;

use thecodeholicc\phpmvcc\db\DbModel;

abstract class UserModel extends  DbModel
{
    abstract  public  function  getDisplayName():String;
}