<?php
namespace Calculator\Operation\Application;

class OperationRequest{

    /**
     * $var string
     */
    private $expression;
    
    /**
     * @param string $expression
     */
    public function __construct($expression)
	{
		$this->expression = $expression;
    }
    
    /**
    * @return string
    */
    public function getExpression(): string
    {
        return $this->expression;
    }

}