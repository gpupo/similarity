<?php
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
        return array(
            array('Ola senhor José', 'Ola senhora Josefina'),
            array('OLA SENHOR JOSÉ', 'Ola senhora Josefina'),
            array(
                'Padre Anchieta 1873 - Champagnat',
                'Champagnat - Padre Anchieta 1873',
            ),
            array(
                'Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Curitiba - Champagnat - Padre Anchieta 1873',
            ),
            array(
                'Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - PR - Curitiba - Champagnat - Padre Anchieta 1873',
            ),
            array(
                'Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Padre Anchieta 1873',
            ),
            array(
                'Av. Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Padre Anchieta 1873',
            ),
            array(
                'Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Padre Anchieta 1873',
            ),
        );
    }
    public function dataProviderSimilarStringsWithStopWords()
    {
        return array(
            array(
                'Av. Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Rua Padre Anchieta 1873',
            ),
            array(
                'Av. Padre Anchieta 1873 - Champagnat - Curitiba - Brasil',
                'Brasil - Parana - Curitiba - Champagnat - Rua Padre Anchieta 1873 - Perto da Avenida',
            ),
        );
    }
    public function dataProviderDifferentStrings()
    {
        return array(
            array('Ola senhor José', 'Bom dia senhora Gertrudes'),
            array(
                'Padre Agostinho 187 - Champagnat',
                'Champagnat - Padre Anchieta 1873',
            ),
            array(
                'Padre Anchieta 187 - Bigorrilho - Curitiba - Brasil',
                'Brasil - Curitiba - Champagnat - Pe. Anchieta 1873',
            ),
        );
    }

    public function dataProviderApproximateNumber()
    {
        return array(
            array(1,2),
            array(3,4),
            array('3D',4),
            array('5D',4),
            array('1530D',1510),
        );
    }

    public function dataProviderSimilarNumbers()
    {
        return array(
            array(1, 1),
            array('2', '2'),
            array('3 ', '3'),
            array('3D ', '3'),
            array('A3D ', '3'),
            array('3 - D ', '3'),
            array('3 - D 4', '34'),
            array('Door 4', '4'),
        );
    }
}
