# Similarity

Calculate the similarity between strings or numbers

[![Build Status](https://secure.travis-ci.org/gpupo/similarity.png?branch=master)](http://travis-ci.org/gpupo/similarity)


## Usage

### Example 1, with stopwords:

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
        "gpupo/similarity": "1.*"
    }
}
```

## Tests

All tests are run automatically at each commit, on ``OSx`` and ``Linux`` environment in PHP versions ``5.3``, ``5.4``, ``5.5``, ``5.6`` and ``hhvm`` using  [Travis](http://travis-ci.org/gpupo/similarity).


To run localy the test suite:

    $ phpunit
    
or see the testdox output

    $ phpunit --testdox    
    
	    
### Current Results
	    
	Gpupo\Tests\Similarity\Input\Decorator
	 [x] Clean characters
	 [x] Clean numbers
	
	Gpupo\Tests\Similarity\Input\InputNumber
	 [x] Clean ignored characters
	
	Gpupo\Tests\Similarity\Input\InputString
	 [x] Clean ignored characters
	 [x] Clean stopwords
	
	Gpupo\Tests\Similarity\SimilarNumber
	 [x] Success to find similarity
	 [x] Success to find proximity
	 [x] Success to find proximity with distant numbers
	
	Gpupo\Tests\Similarity\SimilarText
	 [x] Success to find percentage similarity
	 [x] Success to find percentage with texts with no similarity
	 [x] Success to find the levenshtein distance
	
	Gpupo\Tests\Similarity\Similarity
	 [x] Success on assert similarities with strings
	 [x] Success in asserting that the phrase is different
	 [x] Success on assert similarities with numbers
	 [x] Success on assert similarities with approximate numbers
	 [x] Success on assert with different numbers
	 [x] Ability to increase the accuracy
	 [x] Ability to decrease the accuracy
	 [x] Ability to inject stopwords    
	

## Contributors

* [@gpupo](https://github.com/gpupo)
* [@ricbra](https://github.com/ricbra)

## License

MIT, see LICENSE.


## Links


* [Similarity Composer Package](https://packagist.org/packages/gpupo/similarity) on packagist.org