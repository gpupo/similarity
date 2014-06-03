<?php

namespace Gpupo\Tests\Similarity\Input;

class TestCaseAbstract extends \PHPUnit_Framework_TestCase
{
    public function dataProviderStringsWithIgnoredCharacters()
    {
        return array(
            array('Some - string', 'Some string'),
            array('Some -    string', 'Some string'),
            array('Some - $ % ] ( ) s#tring', 'Some string'),
        );
    }

    public function dataProviderStringsWithStopwords()
    {
        return array(
            array('And Some - string', 'Some string'),
            array('Or Some -    string', 'Some string'),
            array('Xor Some - $ % ] ( ) s#tring', 'Some string'),
            array('Xorg Some - $ % ] ( ) s#tring', 'Xorg Some string'),
        );
    }
    
    public function dataProviderNumbersWithIgnoredCharacters()
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
}
