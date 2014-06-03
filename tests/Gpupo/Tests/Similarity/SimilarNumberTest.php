<?php
namespace Gpupo\Tests\Similarity;

use Gpupo\Similarity\Input\InputNumber;
use Gpupo\Similarity\SimilarNumber;

class SimilarNumberTest extends \PHPUnit_Framework_TestCase
{
    protected function outputDebugInformation(SimilarNumber $s)
    {
        return "\nDebug information:\n" . json_encode($s->__toArray());
    }
    /**
     * @dataProvider dataProviderSimilarNumbers
     */
    public function testSuccessToFindSimilarity($a, $b)
    {
        $i = new InputNumber($a, $b);
        $s = new SimilarNumber($i);

        $this->assertTrue($s->isEquals());
    }

    /**
     * @dataProvider dataProviderApproximateNumbers
     */
    public function testSuccessToFindProximity($a, $b)
    {
        $i = new InputNumber($a, $b);
        $s = new SimilarNumber($i);
        $this->assertTrue($s->isApproximate(), $this->outputDebugInformation($s));
    }

    /**
     * @dataProvider dataProviderDistantNumbers
     */
    public function testSuccessToFindProximityWithDistantNumbers($a, $b)
    {
        $i = new InputNumber($a, $b);
        $s = new SimilarNumber($i);
        $this->assertFalse($s->isApproximate(), $this->outputDebugInformation($s));
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
        );
    }

    public function dataProviderApproximateNumbers()
    {
        return array(
            array(12, 1),
            array(15, 26),
            array(155, 179),
            array(1530, 1562),
        );
    }
    public function dataProviderDistantNumbers()
    {
        return array(
            array(14, 1),
            array(15, 38),
            array(155, 125),
            array(1530, 1570),
        );
    }
}
