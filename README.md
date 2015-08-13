# Similarity

Calculate the similarity between strings or numbers

* Supports [Stopwords](http://en.wikipedia.org/wiki/Stop_words)
* Working in a different way from a diff tool

[![Build Status](https://secure.travis-ci.org/gpupo/similarity.png?branch=master)](http://travis-ci.org/gpupo/similarity)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gpupo/similarity/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gpupo/similarity/?branch=master)
[![Code Climate](https://codeclimate.com/github/gpupo/similarity/badges/gpa.svg)](https://codeclimate.com/github/gpupo/similarity)
[![Test Coverage](https://codeclimate.com/github/gpupo/similarity/badges/coverage.svg)](https://codeclimate.com/github/gpupo/similarity/coverage)


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

## Tests

All tests are run automatically at each commit, on ``OSx`` and ``Linux`` environment in PHP versions ``5.3``, ``5.4``, ``5.5``, ``5.6``, ``7.0`` and ``hhvm`` using  [Travis](http://travis-ci.org/gpupo/similarity).


To run localy the test suite:

    $ phpunit

or see the testdox output

    $ phpunit --testdox

## Contributors

* [@gpupo](https://github.com/gpupo)
* [@ricbra](https://github.com/ricbra)

## License

MIT, see LICENSE.


## Links

* [Similarity Composer Package](https://packagist.org/packages/gpupo/similarity) on packagist.org

## Test Docs

<!--
phpunit --testdox | grep -vi php |  sed "s/.*\[*]/-/" | sed 's/.*Gpupo.*/&\'$'\n/g' | sed 's/.*Gpupo.*/&\'$'\n/g' | sed 's/Gpupo\\Tests\\Similarity\\/### /g' | sed '/./,/^$/!d' >> README.md
-->
### Input\Decorator

- Clean characters
- Clean numbers

### Input\InputNumber

- Clean ignored characters

### Input\InputString

- Clean ignored characters
- Clean stopwords

### SimilarNumber

- Success to find similarity
- Success to find proximity
- Success to find proximity with distant numbers

### SimilarText

- Success to find percentage similarity
- Success to find percentage with texts with no similarity
- Success to find the levenshtein distance

### Similarity

- Success on assert similarities with strings
- Success in asserting that the phrase is different
- Success on assert similarities with numbers
- Success on assert similarities with approximate numbers
- Success on assert with different numbers
- Ability to increase the accuracy
- Ability to decrease the accuracy
- Ability to inject stopwords
