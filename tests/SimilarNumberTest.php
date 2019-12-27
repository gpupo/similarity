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

use Gpupo\Similarity\Input\InputNumber;
use Gpupo\Similarity\SimilarNumber;

/**
 * @coversNothing
 */
class SimilarNumberTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataProviderSimilarNumbers
     *
     * @param mixed $a
     * @param mixed $b
     */
    public function testSuccessToFindSimilarity($a, $b)
    {
        $i = new InputNumber($a, $b);
        $s = new SimilarNumber($i);

        $this->assertTrue($s->isEquals());
    }

    /**
     * @dataProvider dataProviderApproximateNumbers
     *
     * @param mixed $a
     * @param mixed $b
     */
    public function testSuccessToFindProximity($a, $b)
    {
        $i = new InputNumber($a, $b);
        $s = new SimilarNumber($i);
        $this->assertTrue($s->isApproximate(), $this->outputDebugInformation($s));
    }

    /**
     * @dataProvider dataProviderDistantNumbers
     *
     * @param mixed $a
     * @param mixed $b
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

    protected function outputDebugInformation(SimilarNumber $s)
    {
        return "\nDebug information:\n".json_encode($s->__toArray());
    }
}
