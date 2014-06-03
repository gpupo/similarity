<?php

namespace Gpupo\Tests\Similarity\Input;

use  Gpupo\Similarity\Input\Decorator;

class DecoratorTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderStringsWithIgnoredCharacters
     */
    public function testCleanCharacters($string, $expected)
    {
        $d = new Decorator;
        $this->assertEquals($expected, $d->stripIgnoredCharacters($string));
    }

    /**
     * @dataProvider dataProviderNumbersWithIgnoredCharacters
     */
    public function testCleanNumbers($number, $expected)
    {
        $d = new Decorator;
        $this->assertEquals($expected, $d->onlyNumbers($number));
    }

}
