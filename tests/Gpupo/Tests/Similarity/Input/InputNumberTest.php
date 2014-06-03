<?php

namespace Gpupo\Tests\Similarity\Input;

use Gpupo\Similarity\Input\InputNumber;

class InputNumberTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderNumbersWithIgnoredCharacters
     */
    public function testCleanIgnoredCharacters($number, $expected)
    {
        $i = new InputNumber($number, $number);
        $this->assertEquals($expected, $i->getFirst());
        //$this->assertEquals($expected, $i->getSecond());
    }
}
