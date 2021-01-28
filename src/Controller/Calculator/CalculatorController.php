<?php

namespace App\Controller\Calculator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class CalculatorController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('calculator/index.html.twig',
        [
            'result' => 0
        ]);
    }

    public function resolveExpression(Request $request):JsonResponse
    {
        
        $expression = $request->request->get('expression');

        return $this->json([
            'result' => $expression
        ]);

    }

}   