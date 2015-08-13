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

namespace Gpupo\Tests\Similarity;

use Gpupo\Similarity\Input\InputString;
use Gpupo\Similarity\SimilarText;

class SimilarTextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderSimilarStrings
     */
    public function testSuccessToFindPercentageSimilarity($a, $b, $percent)
    {
        $i = new InputString($a, $b);
        $s = new SimilarText($i);

        $this->assertGreaterThan($percent, $s->getPercent());
    }

    /**
     * @dataProvider dataProviderTextsWithNoSimilarity
     */
    public function testSuccessToFindPercentageWithTextsWithNoSimilarity($a, $b, $percent)
    {
        $i = new InputString($a, $b);
        $s = new SimilarText($i);

        $this->assertLessThan($percent, $s->getPercent());
    }

    /**
     * Check the Success to find the distance.
     *
     * @dataProvider dataProviderStringsWithDistance
     */
    public function testSuccessToFindTheLevenshteinDistance($a, $b, $distance)
    {
        $i = new InputString($a, $b, [1, 1, 1]);
        $l = new SimilarText($i);
        $result = $l->getLevenshteinDistance();
        $this->assertEquals($distance, $result);
    }

    public function dataProviderSimilarStrings()
    {
        return [
            ['Ola senhor José', 'Ola senhora Josefina', 77],
            ['OLA SENHOR JOSÉ', 'Ola senhora Josefina', 22,77],
            ['Ola senhor José', 'Ola senhorita Josefina', 33, 3],
            ['Ola senhor José', 'Oi Dona Joana', 0, 34],
            [
                'Padre Anchieta 1873 - Champagnat',
                'Champagnat - Padre Anchieta 1873',
                59,
            ],
        ];
    }

    public function dataProviderTextsWithNoSimilarity()
    {
        return [
            [
                'Bom dia senhor Tadeu',
                'Ola senhora Josefina',
                56,
            ],
            [
                'BEM VINDO SENHOR PEDRO',
                'Ola senhora Josefina',
                48,
            ],
        ];
    }

    public function dataProviderStringsWithDistance()
    {
        return [
            ['kitten', 'sitting', 3],
            ['rosettacode', 'raisethysword', 8],
            ['saturday', 'sunday', 3],
            ['sunday saturday', 'saturday sunday', 6],
            [
                'Padre Anchieta 987 - Champagnat',
                'Champagnat - Padre Anchieta 987',
                22,
            ],
        ];
    }
}
