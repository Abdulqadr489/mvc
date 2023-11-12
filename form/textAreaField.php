<?php

namespace thecodeholic\phpmvc\form;

class textAreaField extends BaseField
{

    public function RenderInput(): string
    {
        return sprintf(' <textarea name="%s" value="%s"  class="form-control%s"></textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',

            $this->model->{$this->attribute},
        );
    }
}