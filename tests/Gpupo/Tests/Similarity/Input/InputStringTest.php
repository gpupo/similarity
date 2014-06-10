<?php

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
        $i->setStopwords(array('and', 'or', 'xor'));
        $this->assertEquals($expected, $i->getFirst());
    }
}
