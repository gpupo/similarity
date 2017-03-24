<?php

/*
 * This file is part of gpupo/similarity
 * Created by Gilmar Pupo <contact@gpupo.com>
 * For the information of copyright and license you should read the file
 * LICENSE which is distributed with this source code.
 * Para a informação dos direitos autorais e de licença você deve ler o arquivo
 * LICENSE que é distribuído com este código-fonte.
 * Para obtener la información de los derechos de autor y la licencia debe leer
 * el archivo LICENSE que se distribuye con el código fuente.
 * For more information, see <https://www.gpupo.com/>.
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
