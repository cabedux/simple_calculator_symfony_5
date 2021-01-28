<?php

namespace Calculator\Operation\Domain;

class Expression{

    /**
     * @var string
     */
    private $operator;

    /**
     * @var integer
     */
    private $firstNumber;

    /**
     * @var integer
     */
    private $secondNumber;

    public function __construct($operator, $firstNumber, $secondNumber){

        $this->operator = $operator;
        $this->firstNumber = $firstNumber;
        $this->secondNumber = $secondNumber;
    }

    /**
    * @return string
    */
    public function getOperator(): string
    {
        return $this->operator;
    }

    
    /**
    * @return integer
    */
    public function getFirstNumber(): int
    {
        return $this->firstNumber;
    }

    
    /**
    * @return string
    */
    public function getSecondNumber(): int
    {
        return $this->secondNumber;
    }
}