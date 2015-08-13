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

class InputNumber extends InputString
{
    protected function getCleanStringValue($key)
    {
        $d = new Decorator();
        $value = $this->get($key);

        return $d->onlyNumbers($value);
    }
}
