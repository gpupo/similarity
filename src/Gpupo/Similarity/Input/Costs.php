<?php

namespace Gpupo\Similarity\Input;

class Costs extends \ArrayObject
{
    public function __construct($first = null, $second = null,
        Array $third = null)
    {
        if (is_array($first)) {
           $array = array_combine(array('insertion', 'replacement', 'deletion'), $first);
        } else {
            $array = array(
                'insertion'     => $first,
                'replacement'   => $second,
                'deletion'      => $third,
            );
        }

        parent::__construct(array_map('intVal', $array), parent::ARRAY_AS_PROPS);
    }
}
