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
    public function sendAddExpressionGetResultTest(){
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

    
    /**
     * @test
     */
    public function sendmultiplicationExpressionGetResultTest(){
        $expression = new OperationRequest('10*10');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), '100');
    }

    
    /**
     * @test
     */
    public function sendDivisionExpressionGetResultTest(){
        $expression = new OperationRequest('100/2');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), '50');
    }

    /**
     * @test
     */
    public function sendDivisionByZeroExpressionGetResultTest(){
        $expression = new OperationRequest('10/0');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), 'E');
    }

    /**
     * @test
     */
    public function sendErrorExpressionGetResultTest(){
        $expression = new OperationRequest('*10+/0');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), 'E');
    }

    /**
     * @test
     */
    public function sendOtherErrorExpressionGetResultTest(){
        $expression = new OperationRequest('-10**20');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), 'E');
    }

    /**
     * @test
     */
    public function sendOtherErrorExpressionwithOperatorToEndGetResultTest(){
        $expression = new OperationRequest('/10*25+');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), 'E');
    }

    /**
     * @test
     */
    public function sendExpressionwithOutOperatorGetResultTest(){
        $expression = new OperationRequest('1020');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), '1020');
    }

    /**
     * @test
     */
    public function sendExpressionwithConsecutiveOperatorGetResultTest(){
        $expression = new OperationRequest('-10/-20');
        $result = $this->handler->handle($expression);

        $this->assertEquals($result->getResult(), '0.5');
    }

}