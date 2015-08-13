<?php

/*
 * This file is part of gpupo/similarity
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * For more information, see
 * <http://www.g1mr.com/similarity/>.
 */

namespace Gpupo\Similarity\Input;

class Costs extends \ArrayObject
{
    public function __construct($first = null, $second = null,
        Array $third = null)
    {
        if (is_array($first)) {
            $array = array_combine(['insertion', 'replacement', 'deletion'], $first);
        } else {
            $array = [
                'insertion'     => $first,
                'replacement'   => $second,
                'deletion'      => $third,
            ];
        }

        parent::__construct(array_map('intVal', $array), parent::ARRAY_AS_PROPS);
    }
}
