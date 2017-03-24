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

namespace Gpupo\Similarity;

use Gpupo\Similarity\Input\InputInterface;

abstract class SimilarityAbstract
{
    const ACCURACY_DEFAULT = 60;

    protected $input;

    protected $accuracy;

    protected function getAccuracy()
    {
        if (empty($this->accuracy)) {
            $this->setAccuracy(self::ACCURACY_DEFAULT);
        }

        return $this->accuracy;
    }

    public function setAccuracy($number)
    {
        $this->accuracy = intval($number);

        return $this;
    }

    public function isApproximate()
    {
        $calc = $this->getProximityCalculation();

        if ($calc['difference'] <= $calc['limit']['maxDifference']) {
            return true;
        }

        return false;
    }

    protected function getInput()
    {
        if (empty($this->input)) {
            throw new \BadMethodCallException('Missing Input');
        } elseif (!$this->input instanceof InputInterface) {
            throw new \BadMethodCallException('Incompatible Input');
        }

        return $this->input;
    }

    protected function factoryExpert($name)
    {
        $expertObject = __NAMESPACE__.'\\Similar'.ucfirst($name);

        $expert = new $expertObject($this->getInput(), $this->getAccuracy());

        return $expert;
    }

    public function __construct(InputInterface $input = null, $accuracy = null)
    {
        if ($input) {
            $this->input = $input;
        }

        if ($accuracy) {
            $this->setAccuracy($accuracy);
        }
    }

    public function __toString()
    {
        return json_encode($this->__toArray());
    }

    public function __toArray()
    {
        return [
            'input'    => $this->input,
            'first'    => $this->getInput()->getFirst(),
            'second'   => $this->getInput()->getSecond(),
            'accuracy' => $this->getAccuracy(),
        ];
    }
}
