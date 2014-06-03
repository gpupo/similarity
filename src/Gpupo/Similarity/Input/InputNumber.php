<?php

namespace Gpupo\Similarity\Input;

class InputNumber extends InputString
{
    protected function getCleanStringValue($key)
    {
        $d = new Decorator;
        $value = $this->get($key);

        return $d->onlyNumbers($value);
    }

}
