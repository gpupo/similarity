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
        $calc = [
            'first'  => $this->getInput()->getFirst(),
            'second' => $this->getInput()->getSecond(),
        ];
        $calc['limit'] = $this->getLimitOfProximity($calc['first'], $calc['second']);
        $calc['ld'] = $this->getLevenshteinDistance();
        $calc['hardDistance'] = $this->getLevenshteinHardDistance();
        $calc['hardDifference'] = ($calc['hardDistance'] / $calc['limit']['hardDivider']) + 0.5;

        if ($calc['hardDifference'] > $calc['ld']
            && $calc['hardDifference'] >= ($calc['limit']['maxDifference'] - 1)) {
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
        $calc = [
            'chars'       => strlen($first.$second),
            'divider'     => (20 - ($this->getAccuracy() / 10)),
            'hardDivider' => (12 - floor(($this->getAccuracy() / 10))),
        ];

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
        $a = [];

        foreach ([
            [$stringA, strtolower($stringB)],
            [strtolower($stringA), strtolower($stringB)],
            [strtolower($stringA), $stringB],
        ] as $item) {
            $a[] = $this->calculatePercent($item[0], $item[1]);
        }

        return max($a);
    }

    public function __toArray()
    {
        return array_merge(parent::__toArray(), [
            'percentage'           => $this->getPercent(),
            'isApproximate'        => $this->isApproximate(),
            'proximityCalculation' => $this->getProximityCalculation(),
        ]);
    }
}
