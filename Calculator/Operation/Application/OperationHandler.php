<?php
namespace Calculator\Operation\Application;

use Calculator\Operation\Application\OperationRequest;
use Calculator\Operation\Application\OperationResponse;

class OperationHandler{

    public function __construct(){

    }

    public function handle(OperationRequest $operation): OperationResponse {

        //@TODO: Logic to resolve expression

        $result = $this->getResult($operation->getExpression(),$this->getOperator($operation->getExpression()));
        
        return new OperationResponse($result);
    }

  /**
    * Obtener el simbolo matematico de operacion
    **/
    private function getOperator($expression){
        $operator = "-";//Suponemos que el operador sera "-"
        for($i = 0; $i < strlen($expression) && $operator == "-"; $i++){
            if(!is_numeric($expression[$i]) && $expression[$i] !="-"){
                $operator = $expression[$i];
            }
        }
        return $operator;
    }

    /**
     * Dado el string y el operador, calcula el resultado de la operación
     **/
    private function getResult($expression, $operator){
        $negative = -1;
        $result = "";
        $arrayExpression = explode($operator, $expression);
        switch($operator){
            case '+':
                $result = intval($arrayExpression[0]) + 
                    intval($arrayExpression[1]);
                break;
            case '-':
                if(substr($expression, 0, 1) === "-"){
                    $result = (intval($arrayExpression[1]) * $negative) - 
                        intval($arrayExpression[2]);
                }
                else{
                    $result = intval($arrayExpression[0]) - 
                        intval($arrayExpression[1]);
                }
                break;
            default:
                $result = $expression;
        }

        return $result;
    }  
}