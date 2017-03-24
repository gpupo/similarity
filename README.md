


# Similarity

Calculate the similarity between strings or numbers

* Supports [Stopwords](http://en.wikipedia.org/wiki/Stop_words)
* Working in a different way from a diff tool


[![Paypal Donations](https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EK6F2WRKG7GNN&item_name=similarity)



<!-- require -->

## Requisitos para uso

* PHP >= *5.6*
* [curl extension](http://php.net/manual/en/intro.curl.php)
* [Composer Dependency Manager](http://getcomposer.org)

Este componente **não é uma aplicação Stand Alone** e seu objetivo é ser utilizado como biblioteca.
Sua implantação deve ser feita por desenvolvedores experientes.

**Isto não é um Plugin!**

As opções que funcionam no modo de comando apenas servem para depuração em modo de
desenvolvimento.

A documentação mais importante está nos testes unitários. Se você não consegue ler os testes unitários, eu recomendo que não utilize esta biblioteca.


<!-- //require -->



## Direitos autorais e de licença

Este componente está sob a [licença MIT](https://github.com/gpupo/common-sdk/blob/master/LICENSE)

Para a informação dos direitos autorais e de licença você deve ler o arquivo
de [licença](https://github.com/gpupo/common-sdk/blob/master/LICENSE) que é distribuído com este código-fonte.

### Resumo da licença

Exigido:

- Aviso de licença e direitos autorais

Permitido:

- Uso comercial
- Modificação
- Distribuição
- Sublicenciamento

Proibido:

- Responsabilidade Assegurada



---

## Indicadores de qualidade

[![Build Status](https://secure.travis-ci.org/gpupo/similarity.png?branch=master)](http://travis-ci.org/gpupo/similarity)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gpupo/similarity/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gpupo/similarity/?branch=master)
[![Code Climate](https://codeclimate.com/github/gpupo/similarity/badges/gpa.svg)](https://codeclimate.com/github/gpupo/similarity)
[![Test Coverage](https://codeclimate.com/github/gpupo/similarity/badges/coverage.svg)](https://codeclimate.com/github/gpupo/similarity/coverage)



---

## Agradecimentos

* A todos os que [contribuiram com patchs](https://github.com/gpupo/similarity/contributors);
* Aos que [fizeram sugestões importantes](https://github.com/gpupo/similarity/issues);
* Aos desenvolvedores que criaram as [bibliotecas utilizadas neste componente](https://github.com/gpupo/similarity/blob/master/Resources/doc/libraries-list.md).

 _- [Gilmar Pupo](https://opensource.gpupo.com/)_





## Usage

### Example 1, with stopwords:

```PHP

	$stringA = 'Av. Padre Anchieta 1873 - Champagnat - Curitiba - Brasil';
	$stringB = 'Brasil - Parana - Curitiba - Champagnat - '
		.'Rua Padre Anchieta 1873 - Perto da Avenida';
	$stopwordsList = explode(',', 'Av,Rua,Avenida,perto,da,de,e,em,o');
	$s = new Similarity();
    $s->setValues($stringA, $stringB);
    $s->setAccuracy(80); // 1-100 accuracy value
    $s->setStopwords($stopwordsList);
	$similar = $s->hasSimilarity(); //true
```

### Example 2, chain method calls:

```PHP

	$s = new Similarity();
    $result = $s->setValues($stringA, $stringB)->setAccuracy(60)
    	->setStopwords($stopwordsList)->hasSimilarity();
```

### Example 3, numbers:

```PHP

	$s = new Similarity();
    $resultA = $s->setNumberValues('1530D',1510)->hasSimilarity(); // true
	$resultB = $s->setNumberValues('3D',4)->hasSimilarity(); // true
	$resultC = $s->setNumberValues('100B',205)->hasSimilarity(); // false
	$resultD = $s->setNumberValues('20',2)->hasSimilarity(); // false
	$resultE = $s->setNumberValues('3 - D 4',34)->hasSimilarity(); // true
```

## Install

The recommended way to install is [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "gpupo/similarity": "dev-master"
    }
}
```









## Links

* [Similarity Composer Package](https://packagist.org/packages/gpupo/similarity) on packagist.org







## Tests

All tests are run automatically at each commit, on ``OSx`` and ``Linux`` environment in PHP versions ``5.3``, ``5.4``, ``5.5``, ``5.6``, ``7.0`` and ``hhvm`` using  [Travis](http://travis-ci.org/gpupo/similarity).


To run localy the test suite:

    $ phpunit

See the testdox output

    $ phpunit --testdox







---

## Propriedades dos objetos



### Similarity\Input\Decorator


- [x] Clean characters
- [x] Clean numbers

### Similarity\Input\InputNumber


- [x] Clean ignored characters

### Similarity\Input\InputString


- [x] Clean ignored characters
- [x] Clean stopwords

### Similarity\SimilarNumber


- [x] Success to find similarity
- [x] Success to find proximity
- [x] Success to find proximity with distant numbers

### Similarity\SimilarText


- [x] Success to find percentage similarity
- [x] Success to find percentage with texts with no similarity
- [x] Success to find the levenshtein distance

### Similarity\Similarity


- [x] Success on assert similarities with strings
- [x] Success in asserting that the phrase is different
- [x] Success on assert similarities with numbers
- [x] Success on assert similarities with approximate numbers
- [x] Success on assert with different numbers
- [x] Ability to increase the accuracy
- [x] Ability to decrease the accuracy
- [x] Ability to inject stopwords





## Lista de dependências (libraries)

Name | Version | Description
-----|---------|------------------------------------------------------
codeclimate/php-test-reporter | v0.4.4 | PHP client for reporting test coverage to Code Climate
doctrine/instantiator | 1.0.5 | A small, lightweight utility to instantiate objects in PHP without invoking their constructors
gpupo/cache | 1.3.0 | Caching library that implements PSR-6
gpupo/common | 1.7.6 | Common Objects
gpupo/common-sdk | 2.2.15 | Componente de uso comum entre SDKs para integração a partir de aplicações PHP com Restful webservices
guzzle/guzzle | v3.9.3 | PHP HTTP client. This library is deprecated in favor of https://packagist.org/packages/guzzlehttp/guzzle
monolog/monolog | 1.22.1 | Sends your logs to files, sockets, inboxes, databases and various web services
myclabs/deep-copy | 1.6.0 | Create deep copies (clones) of your objects
padraic/humbug_get_contents | 1.0.4 | Secure wrapper for accessing HTTPS resources with file_get_contents for PHP 5.3+
padraic/phar-updater | 1.0.3 | A thing to make PHAR self-updating easy and secure.
phpdocumentor/reflection-common | 1.0 | Common reflection classes used by phpdocumentor to reflect the code structure
phpdocumentor/reflection-docblock | 3.1.1 | With this component, a library can provide support for annotations via DocBlocks or otherwise retrieve information that is embedded in a DocBlock.
phpdocumentor/type-resolver | 0.2.1 | 
phpspec/prophecy | v1.7.0 | Highly opinionated mocking framework for PHP 5.3+
phpunit/php-code-coverage | 4.0.7 | Library that provides collection, processing, and rendering functionality for PHP code coverage information.
phpunit/php-file-iterator | 1.4.2 | FilterIterator implementation that filters files based on a list of suffixes.
phpunit/php-text-template | 1.2.1 | Simple template engine.
phpunit/php-timer | 1.0.9 | Utility class for timing
phpunit/php-token-stream | 1.4.11 | Wrapper around PHP's tokenizer extension.
phpunit/phpunit | 5.7.17 | The PHP Unit Testing framework.
phpunit/phpunit-mock-objects | 3.4.3 | Mock Object library for PHPUnit
psr/cache | 1.0.0 | Common interface for caching libraries
psr/log | 1.0.2 | Common interface for logging libraries
satooshi/php-coveralls | v1.0.1 | PHP client library for Coveralls API
sebastian/code-unit-reverse-lookup 1.0.1 | Looks up which function or method a line of code belongs to
sebastian/comparator | 1.2.4 | Provides the functionality to compare PHP values for equality
sebastian/diff | 1.4.1 | Diff implementation
sebastian/environment | 2.0.0 | Provides functionality to handle HHVM/PHP environments
sebastian/exporter | 2.0.0 | Provides the functionality to export PHP variables for visualization
sebastian/global-state | 1.1.1 | Snapshotting of global state
sebastian/object-enumerator | 2.0.1 | Traverses array structures and object graphs to enumerate all referenced objects
sebastian/peek-and-poke | dev-master a8295 | Proxy for accessing non-public attributes and methods of an object
sebastian/recursion-context | 2.0.0 | Provides functionality to recursively process PHP variables
sebastian/resource-operations | 1.0.0 | Provides a list of PHP built-in functions that operate on resources
sebastian/version | 2.0.1 | Library that helps with managing the version number of Git-hosted PHP projects
symfony/config | v3.2.6 | Symfony Config Component
symfony/console | v3.2.6 | Symfony Console Component
symfony/debug | v3.2.6 | Symfony Debug Component
symfony/event-dispatcher | v2.8.18 | Symfony EventDispatcher Component
symfony/filesystem | v3.2.6 | Symfony Filesystem Component
symfony/polyfill-mbstring | v1.3.0 | Symfony polyfill for the Mbstring extension
symfony/stopwatch | v3.2.6 | Symfony Stopwatch Component
symfony/yaml | v3.2.6 | Symfony Yaml Component
twig/twig | v2.3.0 | Twig, the flexible, fast, and secure template language for PHP
webmozart/assert | 1.2.0 | Assertions to validate method input/output with nice error messages.






