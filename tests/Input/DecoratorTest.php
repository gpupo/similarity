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

use Gpupo\Similarity\Input\Decorator;

class DecoratorTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderStringsWithIgnoredCharacters
     */
    public function testCleanCharacters($string, $expected)
    {
        $d = new Decorator();
        $this->assertEquals($expected, $d->stripIgnoredCharacters($string));
    }

    /**
     * @dataProvider dataProviderNumbersWithIgnoredCharacters
     */
    public function testCleanNumbers($number, $expected)
    {
        $d = new Decorator();
        $this->assertEquals($expected, $d->onlyNumbers($number));
    }
}
