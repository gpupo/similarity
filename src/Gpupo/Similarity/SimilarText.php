<?php

namespace Gpupo\Similarity;

class SimilarText extends SimilarityAbstract
{
    public function hasSimilarity()
    {
        if ($this->getPercent() > $this->getAccuracy()) {
            return true;
        }

        if ($this->isApproximate()) {
            return true;
        }

        return false;
    }

    public function getPercent()
    {
        return $this->calculatePercentExtended(
            $this->getInput()->getFirst(),
            $this->getInput()->getSecond()
        );
    }

    public function getLevenshteinDistance()
    {
        return levenshtein(
            $this->getInput()->getFirst(),
            $this->getInput()->getSecond(),
            $this->getInput()->getCosts()->insertion,
            $this->getInput()->getCosts()->replacement,
            $this->getInput()->getCosts()->deletion
        );
    }

    public function getLevenshteinHardDistance()
    {
        return levenshtein(
            $this->getInput()->getFirst(),
            $this->getInput()->getSecond()
        );
    }

    public function getProximityCalculation()
    {
        $calc = array(
            'first'     => $this->getInput()->getFirst(),
            'second'    => $this->getInput()->getSecond(),
        );
        $calc['limit'] = $this->getLimitOfProximity($calc['first'], $calc['second']);
        $calc['ld'] = $this->getLevenshteinDistance();
        $calc['hardDistance'] = $this->getLevenshteinHardDistance();
        $calc['hardDifference'] = ($calc['hardDistance']/$calc['limit']['hardDivider']) + 0.5;

        if ($calc['hardDifference'] > $calc['ld']
            && $calc['hardDifference'] >= ($calc['limit']['maxDifference']-1) ) {
            $calc['mode'] = 'hard';
            $calc['difference'] = $calc['hardDifference'];
        } else {
            $calc['mode'] = 'soft';
            $calc['difference'] = $calc['ld'];
        }

        return $calc;
    }

    protected function getLimitOfProximity($first, $second)
    {
        $calc = array(
            'chars'         => strlen($first . $second),
            'divider'       => (20 - ($this->getAccuracy()/10)),
            'hardDivider'   => (12 - floor(($this->getAccuracy()/10))),
        );

        $calc['maxDifference'] = ($calc['chars'] / $calc['divider']);

        return $calc;
    }

    public function calculatePercent($stringA, $stringB)
    {
        $percent = 0;
        similar_text($stringA, $stringB, $percent);

        return $percent;
    }

    public function calculatePercentExtended($stringA, $stringB)
    {
        $a = array();

        foreach (array(
            array($stringA, strtolower($stringB)),
            array(strtolower($stringA), strtolower($stringB)),
            array(strtolower($stringA), $stringB),
        ) as $item) {
            $a[] = $this->calculatePercent($item[0], $item[1]);
        }

        return max($a);
    }

    public function __toArray()
    {
        return array_merge(parent::__toArray(), array(
            'percentage'            => $this->getPercent(),
            'isApproximate'         => $this->isApproximate(),
            'proximityCalculation'  => $this->getProximityCalculation(),
        ));
    }

}
