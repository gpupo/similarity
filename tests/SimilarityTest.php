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

namespace Gpupo\Tests\Similarity;

use Gpupo\Similarity\Similarity;

class SimilarityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderSimilarStrings
     */
    public function testSuccessOnAssertSimilaritiesWithStrings($a, $b)
    {
        $s = new Similarity();
        $this->assertTrue($s->setValues($a, $b)->hasSimilarity(), $s);
    }

    /**
     * @dataProvider dataProviderDifferentStrings
     */
    public function testSuccessInAssertingThatThePhraseIsDifferent($a, $b)
    {
        $s = new Similarity();
        $this->assertFalse($s->setValues($a, $b)->hasSimilarity(), $s);
    }

    /**
     * @dataProvider dataProviderSimilarNumbers
     */
    public function testSuccessOnAssertSimilaritiesWithNumbers($a, $b)
    {
        $s = new Similarity();
        $this->assertTrue($s->setNumberValues($a, $b)->hasSimilarity());
    }

    /**
     * @dataProvider dataProviderApproximateNumber
     */
    public function testSuccessOnAssertSimilaritiesWithApproximateNumbers($a, $b)
    {
        $s = new Similarity();
        $this->assertTrue($s->setNumberValues($a, $b)->hasSimilarity());
    }

    /**
     * @dataProvider dataProviderDifferentNumber
     */
    public function testSuccessOnAssertWithDifferentNumbers($a, $b)
    {
        $s = new Similarity();
        $this->assertFalse($s->setNumberValues($a, $b)->hasSimilarity());
    }
    /**
     * @dataProvider dataProviderSimilarStrings
     */
    public function testAbilityToIncreaseTheAccuracy($a, $b)
    {
        $s = new Similarity();

        foreach (range(80, 100) as $number) {
            $s->setAccuracy($number);
            $this->assertFalse($s->setValues($a, $b)->hasSimilarity(), $s);
        }
    }

    /**
     * @dataProvider dataProviderDifferentStrings
     */
    public function testAbilityToDecreaseTheAccuracy($a, $b)
    {
        $s = new Similarity();

        foreach (range(1, 39) as $number) {
            $s->setAccuracy($number);
            $this->assertTrue($s->setValues($a, $b)->hasSimilarity(), $s);
        }
    }

    /**
     * @dataProvider dataProviderSimilarStringsWithStopWords
     */
    public function testAbilityToInjectStopwords($a, $b)
    {
        $s = new Similarity();
        $stopwordsList = explode(',', 'Av,Rua,Avenida,perto,da,de,e,em,o');
        $this->assertTrue($s->setValues($a, $b)->setStopwords($stopwordsList)
            ->hasSimilarity(), $s);
    }

    public function dataProviderSimilarStrings()
    {
        return [
            [
                'Padre Anchieta 1873 - Champagnat',
                'Champagnat - Padre Anchieta 1873',
            ],
            [
                'Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Curitiba - Champagnat - Padre Anchieta 1873',
            ],
            [
                'Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - PR - Curitiba - Champagnat - Padre Anchieta 1873',
            ],
            [
                'Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Padre Anchieta 1873',
            ],
            [
                'Av. Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Padre Anchieta 1873',
            ],
            [
                'Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Padre Anchieta 1873',
            ],
        ];
    }

    public function dataProviderSimilarStringsWithStopWords()
    {
        return [
            [
                'Av. Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Rua Padre Anchieta 1873',
            ],
            [
                'Av. Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Rua Padre Anchieta 1873 - Perto da Avenida',
            ],
        ];
    }

    public function dataProviderDifferentStrings()
    {
        return [
            ['Ola senhor José', 'Bom dia senhora Gertrudes'],
            [
                'Padre Agostinho 187 - Champagnat',
                'Champagnat - Padre Anchieta 1873',
            ],
            [
                'Padre Anchieta 187 - Bigorrilho - Curitiba - Brasil',
                'Brasil - Curitiba - Champagnat - Pe. Anchieta 1873',
            ],
        ];
    }

    public function dataProviderDifferentNumber()
    {
        return [
            [20, 2],
            [20, 202],
            [20, 02],
            [10, 105],
            [100, 205],
            ['100', 205],
            ['100B', 205],
            ['100 B', 205],
        ];
    }

    public function dataProviderApproximateNumber()
    {
        return [
            [1, 2],
            [3, 4],
            ['3D', 4],
            ['5D', 4],
            ['1530D', 1510],
        ];
    }

    public function dataProviderSimilarNumbers()
    {
        return [
            [1, 1],
            ['2', '2'],
            ['3 ', '3'],
            ['3D ', '3'],
            ['A3D ', '3'],
            ['3 - D ', '3'],
            ['3 - D 4', '34'],
            ['Door 4', '4'],
        ];
    }
}
