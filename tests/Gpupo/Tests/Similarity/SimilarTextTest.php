<?php
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
     * Check the Success to find the distance
     *
     * @dataProvider dataProviderStringsWithDistance
     */
    public function testSuccessToFindTheLevenshteinDistance($a, $b, $distance)
    {
        $i = new InputString($a, $b, array(1, 1, 1));
        $l = new SimilarText($i);
        $result = $l->getLevenshteinDistance();
        $this->assertEquals($distance, $result);
    }

    public function dataProviderSimilarStrings()
    {
        return array(
            array('Ola senhor José', 'Ola senhora Josefina', 77),
            array('OLA SENHOR JOSÉ', 'Ola senhora Josefina', 22,77),
            array('Ola senhor José', 'Ola senhorita Josefina', 33, 3),
            array('Ola senhor José', 'Oi Dona Joana', 0, 34),
            array(
                'Padre Anchieta 1873 - Champagnat',
                'Champagnat - Padre Anchieta 1873',
                59,
            )
        );
    }

    public function dataProviderTextsWithNoSimilarity()
    {
        return array(
            array(
                'Bom dia senhor Tadeu',
                'Ola senhora Josefina',
                56,
            ),
            array(
                'BEM VINDO SENHOR PEDRO',
                'Ola senhora Josefina',
                48,
            ),
        );
    }
    
    public function dataProviderStringsWithDistance()
    {
        return array(
            array('kitten', 'sitting', 3),
            array('rosettacode', 'raisethysword', 8),
            array('saturday', 'sunday', 3),
            array('sunday saturday', 'saturday sunday', 6),
            array(
                'Padre Anchieta 987 - Champagnat',
                'Champagnat - Padre Anchieta 987',
                22,
            )
        );
    }
}
