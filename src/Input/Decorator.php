<?php

declare(strict_types=1);

/*
 * This file is part of gpupo/similarity
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://opensource.gpupo.com/>.
 *
 */

namespace Gpupo\Similarity\Input;

class Decorator
{
    /**
     * Remove non alphanumeric characters and replacing multiple spaces with a single space.
     *
     * @param string $string
     *
     * @return string
     */
    public function stripIgnoredCharacters($string)
    {
        $aplhaNumeric = preg_replace('/[^\\w\\d ]/ui', '', $string);

        return $this->stripMultipleSpaces($aplhaNumeric);
    }

    public function stripStopwords($string, $list)
    {
        usort($list, function ($a, $b) {
            return \mb_strlen($b) - \mb_strlen($a);
        });

        $addSpaces = function (&$v) {
            $v = ' '.trim($v).' ';

            return $v;
        };

        array_walk($list, $addSpaces);

        return trim(str_ireplace($list, ' ', $addSpaces($string)));
    }

    public function stripMultipleSpaces($string)
    {
        return $this->stripSpaces($string, ' ');
    }

    public function stripSpaces($string, $replacement = '')
    {
        return preg_replace('!\s+!', $replacement, $string);
    }

    public function onlyNumbers($string)
    {
        $numbers = preg_replace('/[^0-9]/', '', $string);

        return $this->stripSpaces($numbers);
    }
}
