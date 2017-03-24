<?php

/*
 * This file is part of gpupo/similarity
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://www.gpupo.com/>.
 */

namespace Gpupo\Similarity\Input;

abstract class InputAbstract extends \ArrayObject
{
    public function __construct($first = null, $second = null,
        array $costs = null)
    {
        if (is_array($first)) {
            $array = array_combine(['first', 'second', 'costs'], $first);
        } else {
            $array = [
                'first'  => $first,
                'second' => $second,
                'costs'  => $costs,
            ];
        }
        parent::__construct($array, parent::ARRAY_AS_PROPS);

        $this->constructCosts();
    }

    public function setFirst($value)
    {
        return $this->set('first', $value);
    }

    public function setSecond($value)
    {
        return $this->set('second', $value);
    }

    public function setCostsByArray(array $array)
    {
        $this->setCosts(new Costs($array));
    }

    public function setStopwords(array $array)
    {
        $this->set('stopwords', $array);
    }

    public function getStopwords()
    {
        return $this->get('stopwords');
    }

    protected function constructCosts()
    {
        $defaultCosts = [1, 0, 1];

        return $this->setCostsByArray(($this->costs) ? $this->costs : $defaultCosts);
    }

    public function setCosts($value)
    {
        return $this->set('costs', $value);
    }

    protected function set($key, $value)
    {
        $this->$key = $value;
    }

    protected function get($key)
    {
        if ($this->offsetExists($key)) {
            return $this->$key;
        }
    }
}
