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

class InputString extends InputAbstract implements InputInterface
{
    protected function getCleanStringValue($key)
    {
        $d = new Decorator();
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
