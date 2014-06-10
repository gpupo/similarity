# Similarity

Calculate the similarity between strings or numbers

[![Build Status](https://secure.travis-ci.org/gpupo/similarity.png?branch=dev)](http://travis-ci.org/gpupo/similarity)


## Usage

Example 1, with stopwords:

```PHP

	$stringA = 'Av. Padre Anchieta 1873 - Champagnat - Curitiba - Brasil';
	$stringB = 'Brasil - Parana - Curitiba - Champagnat - Rua Padre Anchieta 1873 - Perto da Avenida';
	$stopwordsList = explode(',', 'Av,Rua,Avenida,perto,da,de,e,em,o'); 
	$s = new Similarity();
    $s->setValues($stringA, $stringB);
    $s->setAccuracy(80); // 1-100 accuracy value
    $s->setStopwords($stopwordsList);	
	$similar = $s->hasSimilarity(); //true

```

## Install

The recommended way to install is [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "gpupo/similarity": "1.*"
    }
}
```

## Tests

To run the test suite, you need PHPUnit.

    $ phpunit

## Contributors

* [@gpupo](https://github.com/gpupo)
* [@ricbra](https://github.com/ricbra)

## License

MIT, see LICENSE.




## Links


* [Similarity Composer Package](https://packagist.org/packages/gpupo/similarity) on packagist.org