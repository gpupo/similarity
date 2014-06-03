<?php

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
        if ($this->getInput()->getFirst() == $this->getInput()->getSecond()) {
            return true;
        }

        return false;
    }

    public function getProximityCalculation()
    {
        $calc = array(
            'first'     => $this->getInput()->getFirst(),
            'second'    => $this->getInput()->getSecond(),
        );
        $calc['limit'] = $this->getLimitOfProximity($calc['first'], $calc['second']);
        $calc['difference'] = abs($calc['first'] - $calc['second']);

        return $calc;
    }

    protected function getLimitOfProximity($first, $second)
    {
        $calc = array(
            'chars'         => strlen($first . $second),
            'multiplicator' => (10 - ($this->getAccuracy()/10)),
        );

        $calc['maxDifference'] = ($calc['chars'] * $calc['multiplicator']);

        return $calc;
    }

    public function __toArray()
    {
        return array_merge(parent::__toArray(), array(
            'proximityCalculation' => $this->getProximityCalculation()
        ));
    }
}
