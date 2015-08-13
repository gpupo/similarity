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

namespace Gpupo\Tests\Similarity\Input;

use Gpupo\Similarity\Input\InputString;

class InputStringTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderStringsWithIgnoredCharacters
     */
    public function testCleanIgnoredCharacters($string, $expected)
    {
        $i = new InputString($string, $string);
        $this->assertEquals($expected, $i->getFirst());
    }

    /**
     * @dataProvider dataProviderStringsWithStopwords
     */
    public function testCleanStopwords($string, $expected)
    {
        $i = new InputString($string, $string);
        $i->setStopwords(['and', 'or', 'xor']);
        $this->assertEquals($expected, $i->getFirst());
    }
}
