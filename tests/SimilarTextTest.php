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

namespace Gpupo\Tests\Similarity;

use Gpupo\Similarity\Input\InputString;
use Gpupo\Similarity\SimilarText;

/**
 * @coversNothing
 */
class SimilarTextTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataProviderSimilarStrings
     *
     * @param mixed $a
     * @param mixed $b
     * @param mixed $percent
     */
    public function testSuccessToFindPercentageSimilarity($a, $b, $percent)
    {
        $i = new InputString($a, $b);
        $s = new SimilarText($i);

        $this->assertGreaterThan($percent, $s->getPercent());
    }

    /**
     * @dataProvider dataProviderTextsWithNoSimilarity
     *
     * @param mixed $a
     * @param mixed $b
     * @param mixed $percent
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
     *
     * @param mixed $a
     * @param mixed $b
     * @param mixed $distance
     */
    public function testSuccessToFindTheLevenshteinDistance($a, $b, $distance)
    {
        $i = new InputString($a, $b, [1, 1, 1]);
        $l = new SimilarText($i);
        $result = $l->getLevenshteinDistance();
        $this->assertSame($distance, $result);
    }

    public function dataProviderSimilarStrings()
    {
        return [
            ['Ola senhor José', 'Ola senhora Josefina', 77],
            ['OLA SENHOR JOSÉ', 'Ola senhora Josefina', 22, 77],
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
