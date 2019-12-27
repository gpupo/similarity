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

class Costs extends \ArrayObject
{
    public function __construct(
        $first = null,
        $second = null,
        array $third = null
    ) {
        if (\is_array($first)) {
            $array = array_combine(['insertion', 'replacement', 'deletion'], $first);
        } else {
            $array = [
                'insertion' => $first,
                'replacement' => $second,
                'deletion' => $third,
            ];
        }

        parent::__construct(array_map('intVal', $array), parent::ARRAY_AS_PROPS);
    }
}
