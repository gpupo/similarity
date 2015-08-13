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

use Gpupo\Similarity\Input\InputNumber;
use Gpupo\Similarity\SimilarNumber;

class SimilarNumberTest extends \PHPUnit_Framework_TestCase
{
    protected function outputDebugInformation(SimilarNumber $s)
    {
        return "\nDebug information:\n".json_encode($s->__toArray());
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
        return [
            [1, 1],
            ['2', '2'],
            ['3 ', '3'],
            ['3D ', '3'],
            ['A3D ', '3'],
            ['3 - D ', '3'],
            ['3 - D 4', '34'],
        ];
    }

    public function dataProviderApproximateNumbers()
    {
        return [
            [12, 1],
            [15, 26],
            [155, 179],
            [1530, 1562],
        ];
    }
    public function dataProviderDistantNumbers()
    {
        return [
            [14, 1],
            [15, 38],
            [155, 125],
            [1530, 1570],
        ];
    }
}
