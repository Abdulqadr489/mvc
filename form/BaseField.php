<?php

namespace thephp\phpmvccore\form;

use thephp\phpmvccore\Model;

abstract class BaseField
{
    public Model $model;
    public string $attribute;
    public function __construct(Model $model , string $attribute)
    {
        $this->model=$model;
        $this->attribute=$attribute;
    }
 abstract public function RenderInput():String;

    public function __toString()
    {
        return sprintf('
        <div class="form-group">
        <label>%s</label>
        %s
        <div class="invalid-feedback">
        %s
        </div>
        
        </div>
      ',
            $this->model->getLabel($this->attribute),
            $this->RenderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}