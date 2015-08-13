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

class TestCaseAbstract extends \PHPUnit_Framework_TestCase
{
    public function dataProviderStringsWithIgnoredCharacters()
    {
        return [
            ['Some - string', 'Some string'],
            ['Some -    string', 'Some string'],
            ['Some - $ % ] ( ) s#tring', 'Some string'],
        ];
    }

    public function dataProviderStringsWithStopwords()
    {
        return [
            ['And Some - string', 'Some string'],
            ['Or Some -    string', 'Some string'],
            ['Xor Some - $ % ] ( ) s#tring', 'Some string'],
            ['Xorg Some - $ % ] ( ) s#tring', 'Xorg Some string'],
        ];
    }

    public function dataProviderNumbersWithIgnoredCharacters()
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
}
