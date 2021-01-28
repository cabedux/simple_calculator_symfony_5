<?php

namespace App\tests\Calculator\Operation\Application;

use PHPUnit\Framework\TestCase;
use Calculator\Operation\Application\OperationHandler;
use Calculator\Operation\Application\OperationRequest;
class OperationHandlerTest extends TestCase{

    private $handler;

    public function setUp(): void{
        $this->handler = new OperationHandler();
    }

    /**
     * @test
     */
    public function sendExpressionGetSameExpressionTest(){
        $expression = new OperationRequest('3+3');
        $result = $this->handler->handle($expression);

        $this->assertNotSame($result->getResult(), '3+3');
    }

    /**
     * @test
     */
    public function sendPlusExpressionGetResultTest(){
        $expression = new OperationRequest('3+3');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), '6');
    }

    /**
     * @test
     */
    public function sendSubtractExpressionGetResultTest(){
        $expression = new OperationRequest('10-3');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), '7');
    }

    /**
     * @test
     */
    public function sendSubtractStartwithNegativeExpressionGetResultTest(){
        $expression = new OperationRequest('-10-3');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), '-13');
    }

}