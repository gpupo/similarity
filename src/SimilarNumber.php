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

class SimilarNumber extends SimilarityAbstract implements SimilarInterface
{
    public function __toArray()
    {
        return array_merge(parent::__toArray(), [
            'proximityCalculation' => $this->getProximityCalculation(),
        ]);
    }

    public function hasSimilarity()
    {
        if ($this->isEquals()) {
            return true;
        }

        if ($this->isApproximate()) {
            return true;
        }

        return false;
    }

    public function isEquals()
    {
        if ($this->getInput()->getFirst() === $this->getInput()->getSecond()) {
            return true;
        }

        return false;
    }

    public function getProximityCalculation()
    {
        $calc = [
            'first' => $this->getInput()->getFirst(),
            'second' => $this->getInput()->getSecond(),
        ];
        $calc['limit'] = $this->getLimitOfProximity($calc['first'], $calc['second']);
        $calc['difference'] = abs($calc['first'] - $calc['second']);

        return $calc;
    }

    protected function getLimitOfProximity($first, $second)
    {
        $calc = [
            'chars' => \mb_strlen($first.$second),
            'multiplicator' => (10 - ($this->getAccuracy() / 10)),
        ];

        $calc['maxDifference'] = ($calc['chars'] * $calc['multiplicator']);

        return $calc;
    }
}
