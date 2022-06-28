<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionReportsController extends AbstractController
{
    /**
     * @Route("/transaction/reports", name="app_transaction_reports")
     */
    public function index(): Response
    {
        return $this->render('transaction_reports/index.html.twig', [
            'controller_name' => 'TransactionReportsController',
        ]);
    }
}
