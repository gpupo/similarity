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

namespace Gpupo\Tests\Similarity\Input;

use Gpupo\Similarity\Input\InputString;

/**
 * @coversNothing
 */
class InputStringTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderStringsWithIgnoredCharacters
     *
     * @param mixed $string
     * @param mixed $expected
     */
    public function testCleanIgnoredCharacters($string, $expected)
    {
        $i = new InputString($string, $string);
        $this->assertSame($expected, $i->getFirst());
    }

    /**
     * @dataProvider dataProviderStringsWithStopwords
     *
     * @param mixed $string
     * @param mixed $expected
     */
    public function testCleanStopwords($string, $expected)
    {
        $i = new InputString($string, $string);
        $i->setStopwords(['and', 'or', 'xor']);
        $this->assertSame($expected, $i->getFirst());
    }
}
