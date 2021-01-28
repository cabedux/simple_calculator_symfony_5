<?php
namespace Calculator\Operation\Application;

use Calculator\Operation\Application\OperationRequest;
use Calculator\Operation\Application\OperationResponse;
use Calculator\Operation\Domain\Expression;

class OperationHandler{

    public function __construct(){

    }

    public function handle(OperationRequest $operation): OperationResponse {
      
        return new OperationResponse($this->getResult($this->getExpression($operation)));
    }

    /**
     * Transform string to object Expression
     * @param OperationRequest
     * @return Expression
     */
    private function getExpression(OperationRequest $operation): Expression{

        $negative = -1;
        $operator = $this->getOperator($operation->getExpression());
        $arrayExpression = explode($operator, $operation->getExpression());
                
        if(substr($operation->getExpression(), 0, 1) === "-" && $operator === "-"){
            $arrayExpression[0] = $arrayExpression[1] * $negative;
            $arrayExpression[1] = $arrayExpression[2];
        }

        return new Expression( $operator, $arrayExpression[0], $arrayExpression[1]);
    }

    /**
    * Get type of operator
    * @param string
    * @return string
    **/
    private function getOperator($expression){
        $operator = "-";//Default negative operator
        for($i = 0; $i < strlen($expression) && $operator == "-"; $i++){
            if(!is_numeric($expression[$i]) && $expression[$i] !="-"){
                $operator = $expression[$i];
            }
        }
        return $operator;
    }

    /**
     * Get result of operation
     * @param Expression
     * @return integer
     **/
    private function getResult($expression){
        $result = "E";//Default value error
        switch($expression->getOperator()){
            case '+':
                $result = $expression->getFirstNumber() + 
                          $expression->getSecondNumber();
                break;

            case '-':
                $result = $expression->getFirstNumber() - 
                          $expression->getSecondNumber();
                break;

            case '*':
                $result = $expression->getFirstNumber() * 
                          $expression->getSecondNumber();
                break;

            case '/':                
                if($expression->getSecondNumber() != "0"){//Avoid division by zero
                    $result = $expression->getFirstNumber() / 
                    $expression->getSecondNumber();
                }
                break;
        }

        return $result;
    }  
}