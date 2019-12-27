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

namespace Gpupo\Similarity;

use Gpupo\Similarity\Input\InputNumber;
use Gpupo\Similarity\Input\InputString;

class Similarity extends SimilarityAbstract implements SimilarInterface
{
    const MODE_STRING = 'text';

    const MODE_NUMBER = 'number';

    protected $mode;

    protected $expert;

    public function __toArray()
    {
        return  $this->getExpert()->__toArray();
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

    public function setStopwords(array $list)
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

    public function hasSimilarity(): bool
    {
        return (bool) $this->getExpert()->hasSimilarity();
    }

    protected function getMode(): string
    {
        if (self::MODE_NUMBER === $this->mode) {
            return self::MODE_NUMBER;
        }

        return self::MODE_STRING;
    }

    protected function getExpert()
    {
        if (!$this->expert) {
            $this->expert = $this->factoryExpert($this->getMode());
        }

        return $this->expert;
    }
}
