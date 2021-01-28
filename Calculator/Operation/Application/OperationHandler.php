<?php
namespace Calculator\Operation\Application;

use Calculator\Operation\Application\OperationRequest;
use Calculator\Operation\Application\OperationResponse;

class OperationHandler{

    public function __construct(){

    }

    public function handle(OperationRequest $operation): OperationResponse {

        //@TODO: Logic to resolve expression
        
        return new OperationResponse($operation->getExpression());
    }
}