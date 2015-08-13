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

namespace Gpupo\Similarity;

class SimilarNumber extends SimilarityAbstract implements SimilarInterface
{
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
            'first'     => $this->getInput()->getFirst(),
            'second'    => $this->getInput()->getSecond(),
        ];
        $calc['limit'] = $this->getLimitOfProximity($calc['first'], $calc['second']);
        $calc['difference'] = abs($calc['first'] - $calc['second']);

        return $calc;
    }

    protected function getLimitOfProximity($first, $second)
    {
        $calc = [
            'chars'         => strlen($first.$second),
            'multiplicator' => (10 - ($this->getAccuracy() / 10)),
        ];

        $calc['maxDifference'] = ($calc['chars'] * $calc['multiplicator']);

        return $calc;
    }

    public function __toArray()
    {
        return array_merge(parent::__toArray(), [
            'proximityCalculation' => $this->getProximityCalculation(),
        ]);
    }
}
