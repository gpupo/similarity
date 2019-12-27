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

use Gpupo\Similarity\Input\Decorator;

/**
 * @coversNothing
 */
class DecoratorTest extends TestCaseAbstract
{
    /**
     * @dataProvider dataProviderStringsWithIgnoredCharacters
     *
     * @param mixed $string
     * @param mixed $expected
     */
    public function testCleanCharacters($string, $expected)
    {
        $d = new Decorator();
        $this->assertSame(''.$expected, $d->stripIgnoredCharacters($string));
    }

    /**
     * @dataProvider dataProviderNumbersWithIgnoredCharacters
     *
     * @param mixed $number
     * @param mixed $expected
     */
    public function testCleanNumbers($number, $expected)
    {
        $d = new Decorator();
        $this->assertSame((int) $expected, (int) ($d->onlyNumbers($number)));
    }
}
