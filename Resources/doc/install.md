

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
