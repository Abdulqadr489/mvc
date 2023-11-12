<?php

namespace thephp\phpmvccore;

use thephp\phpmvccore\db\DbModel;

abstract class UserModel extends  DbModel
{
    abstract  public  function  getDisplayName():String;
}