<?php

/*
 * This file is part of the similarity package.
 *
 * (c) Gilmar Pupo <g@g1mr.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gpupo\Similarity;

use Gpupo\Similarity\Input\InputString;
use Gpupo\Similarity\Input\InputNumber;

class Similarity extends SimilarityAbstract implements SimilarInterface
{
    const MODE_STRING = 'text';

    const MODE_NUMBER = 'number';

    protected $mode;

    protected $expert;

    protected function getMode()
    {
        if ($this->mode == self::MODE_NUMBER) {
            return self::MODE_NUMBER;
        }

        return self::MODE_STRING;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
        $this->expert = null;

        return $this;
    }

    public function setValues($a, $b)
    {
        $input = new InputString($a, $b);
        $this->input = $input;

        $this->setMode(self::MODE_STRING);

        return $this;
    }

    public function setStopwords(Array $list)
    {
        $this->getInput()->setStopwords($list);

        return $this;
    }

    public function setNumberValues($a, $b)
    {
        $input = new InputNumber($a, $b);
        $this->input = $input;

        $this->setMode(self::MODE_NUMBER);

        return $this;
    }

    protected function getExpert()
    {
        if (!$this->expert) {
            $this->expert = $this->factoryExpert($this->getMode());
        }

        return $this->expert;
    }

    public function hasSimilarity()
    {
        return $this->getExpert()->hasSimilarity();
    }

    public function __toArray()
    {
        return  $this->getExpert()->__toArray();
    }

}
