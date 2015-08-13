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
