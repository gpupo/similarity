<?php

namespace Gpupo\Similarity;

Use Gpupo\Similarity\Input\InputInterface;

abstract class SimilarityAbstract
{
    const ACCURACY_DEFAULT = 60;

    protected $input;

    protected $accuracy;

    protected function getAccuracy()
    {
        if (empty($this->accuracy)) {
            $this->setAccuracy(self::ACCURACY_DEFAULT);
        }

        return $this->accuracy;
    }

    public function setAccuracy($number)
    {
        $this->accuracy = intval($number);

        return $this;
    }

    public function isApproximate()
    {
        $calc = $this->getProximityCalculation();

        if ($calc['difference'] <= $calc['limit']['maxDifference']) {
            return true;
        }

        return false;
    }

    protected function getInput()
    {
        if (empty($this->input)) {
            throw new \BadMethodCallException('Missing Input');
        } elseif (!$this->input instanceof InputInterface) {
            throw new \BadMethodCallException('Incompatible Input');
        }

        return $this->input;
    }

    protected function factoryExpert($name)
    {
        $expertObject = __NAMESPACE__ . '\\Similar' . ucfirst($name);

        $expert =  new $expertObject($this->getInput(), $this->getAccuracy());

        return $expert;
    }

    public function __construct(InputInterface $input = null, $accuracy = null)
    {
        if ($input) {
            $this->input = $input;
        }

        if ($accuracy) {
            $this->setAccuracy($accuracy);
        }
    }

    public function __toString()
    {
        return json_encode($this->__toArray());
    }

    public function __toArray()
    {
        return array(
            'input'     => $this->input,
            'first'     => $this->getInput()->getFirst(),
            'second'    => $this->getInput()->getSecond(),
            'accuracy'  => $this->getAccuracy(),
        );
    }

}
