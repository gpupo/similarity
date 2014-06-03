<?php

namespace Gpupo\Similarity\Input;

interface InputInterface
{
    public function getFirst();
    public function getSecond();
    public function getCosts();
}
