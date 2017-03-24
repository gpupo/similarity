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

use Gpupo\Similarity\Input\Decorator;

class DecoratorTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderStringsWithIgnoredCharacters
     */
    public function testCleanCharacters($string, $expected)
    {
        $d = new Decorator();
        $this->assertSame(''.$expected, $d->stripIgnoredCharacters($string));
    }

    /**
     * @dataProvider dataProviderNumbersWithIgnoredCharacters
     */
    public function testCleanNumbers($number, $expected)
    {
        $d = new Decorator();
        $this->assertSame(intval($expected), intval($d->onlyNumbers($number)));
    }
}
