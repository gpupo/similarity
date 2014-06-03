<?php

namespace Gpupo\Similarity\Input;

class InputString extends InputAbstract implements InputInterface
{
    protected function getCleanStringValue($key)
    {
        $d = new Decorator;
        $value = $this->get($key);
        $string = $d->stripIgnoredCharacters($value);
        
        if ($this->getStopwords()) {
            return $d->stripStopwords($string, $this->getStopwords());
        }
        
        return $string;
    }

    public function getFirst()
    {
        return $this->getCleanStringValue('first');
    }

    public function getSecond()
    {
        return $this->getCleanStringValue('second');
    }

    public function getCosts()
    {
        return $this->get('costs');
    }
}
