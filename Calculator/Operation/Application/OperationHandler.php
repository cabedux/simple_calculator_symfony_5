<?php
namespace Calculator\Operation\Application;

use Calculator\Operation\Application\OperationRequest;
use Calculator\Operation\Application\OperationResponse;
use Calculator\Operation\Domain\Expression;

class OperationHandler{

    public function __construct(){

    }

    public function handle(OperationRequest $operation): OperationResponse {

        $expression = 'E';
        if($this->isNoOperator($operation)){
            $expression = $operation->getExpression();
        }
        else if(!$this->isIncorrectSentence($operation)){
            $expression = $this->getResult($this->getExpression($operation));
        }

        return new OperationResponse($expression);
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
    
    /**
     * Check is it's a correct expression
     * @param Expression
     * @return bool
     **/
    private function isIncorrectSentence($operation): bool{
        $result = false;
        $expression = $operation->getExpression();
        //Check expression if start (operator != "-") or 
        // end (simbolo = (+,-,*,/))
        if(!is_numeric($expression[strlen($expression)-1]) || 
                substr($expression, 0, 1) === "+" || 
                substr($expression, 0, 1) === "*" ||
                substr($expression, 0, 1) === "/"){//
            $result = true;
        }	
        else{//check pair of values.
            $result = $this->comparePairValue($expression);
        }
        return $result;
    }

    /**
     * Check if the expression is not a operator
     * @param Expression
     * @return bool
     **/
    private function isNoOperator($operation): bool{
        $operator = true;
        $expression = $operation->getExpression();
        for($i = 1; $i < strlen($expression) && $operator == true; $i++){
            if(!is_numeric($expression[$i])){
                $operator = false;
            }
        }
        return $operator;
    }
    
    /**
     * Compare pairs of values that are math symbols
     * @param Expression
     * @return bool
     **/
    private function comparePairValue($expression): bool{
        $result = false;
        for($i = 0; $i < strlen($expression)-1 && $result == false; $i++){
            if(!is_numeric($expression[$i]) && !is_numeric($expression[$i+1])){
                //if they are other than + -, * -, / -
                if($expression[$i] == "-" || $expression[$i+1] != "-"){
                    $result = true;
                }
            }
        }
        return $result;
    }
}