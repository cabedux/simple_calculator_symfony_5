<?php
namespace Calculator\Operation\Application;

class OperationResponse{

    /**
     * $var string
     */
    private $result;
    
    /**
     * @param string $result
     */
    public function __construct($result)
	{
		$this->result = $result;
    }
    
    /**
    * @return string
    */
    public function getResult(): string
    {
        return $this->result;
    }
    
}