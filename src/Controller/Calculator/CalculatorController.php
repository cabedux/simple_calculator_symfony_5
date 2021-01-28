<?php

namespace App\Controller\Calculator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Calculator\Operation\Application\OperationHandler;
use Calculator\Operation\Application\OperationRequest;

class CalculatorController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('calculator/index.html.twig',
        [
            'result' => ''
        ]);
    }

    public function resolveExpression(Request $request, OperationHandler $operationHandler):JsonResponse
    {
        $expression = new OperationRequest($request->request->get('expression'));
        $result = $operationHandler->handle($expression)->getResult();

        return $this->json([
            'result' => $result
        ]);

    }

}   