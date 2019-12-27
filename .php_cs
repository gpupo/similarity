<?php

use Gpupo\CommonDevExtra\CsConfigurator;

$packageInfo = [
    'project' => 'gpupo/similarity',
    'author' => 'Gilmar Pupo <contact@gpupo.com>',
    'url' => 'https://opensource.gpupo.com/',
];

return (new CsConfigurator(__DIR__))->getConfig($packageInfo);
