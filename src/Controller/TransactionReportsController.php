<?php

namespace App\Controller;

use App\Entity\TransactionReports;
use App\Form\TransactionReportsAddType;
use App\Repository\TransactionReportsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransactionReportsController extends AbstractController
{
    /**
     * @Route("/transaction", name="transaction_list")
     */
    public function list_transaction(): Response
    {
        $transactions = $this->getDoctrine()->getRepository(TransactionReports::class)->findAll();
        return $this->render('transaction_reports/index.html.twig', [
            'transactions' => $transactions
        ]);
    }
    /**
     * @Route("/transaction/delete/{id}", name="transaction_delete")
     */
    public function delete_transactions($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $transactions = $em->getRepository(TransactionReports::class)->find($id);
        $em->remove($transactions);
        $em->flush();

        $this->addFlash(
            'error',
            'Transactions deleted'
        );

        return $this->redirectToRoute('transaction_list');

    }
    /**
     * @Route("/transaction/details/{id}", name="transaction_details")
     */
    public function transaction_details($id): Response
    {
        $transactions = $this->getDoctrine()->getRepository(TransactionReports::class)->find($id);
        return $this->render('transaction/details.html.twig', [
            'transactions' => $transactions,
        ]);
    }
    /**
     * @Route("/transaction/create", name="transaction_create", methods={"GET","POST"})
     */
    public function transaction_create(Request $request)
    {
        $transactions = new TransactionReports();
        $form = $this->createForm(TransactionReportsAddType::class, $transactions);

        if ($this->saveChanges($form, $request, $transactions)) {
            $this->addFlash(
                'notice',
                'Transaction Added'
            );

            return $this->redirectToRoute('transaction_list');
        }

        return $this->render('transaction/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $transactions): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($request->request->get('transaction')['DateSupply'])) {
                $transactions->set(\DateTime::createFromFormat('Y-m-d',$request->request->get('transaction')['DateSupply']));
            }
            if (isset($request->request->get('transaction')['CustomerID'])) {
                $transactions->set($request->request->get('transaction')['CustomerID']);
            }
            if (isset($request->request->get('transaction')['OderID'])) {
                $transactions->set($request->request->get('transaction')['OderID']);
            }
            if (isset($request->request->get('transaction')['SupplyID'])) {
                $transactions->set($request->request->get('transaction')['SupplyID']);
            }
            if (isset($request->request->get('transaction')['DeliveryID'])) {
                $transactions->set($request->request->get('transaction')['DeliveryID']);
            }
            if (isset($request->request->get('transaction')['FoodID'])) {
                $transactions->set($request->request->get('transaction')['FoodID']);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($transactions);
            $em->flush();


            return true;
        }
        return false;
    }
    /**
     * @Route("/transaction/edit/{id}", name="transaction_edit")
     */
    public function transaction_edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $transactions = $em->getRepository(TransactionReports::class)->find($id);
        $form = $this->createForm(TransactionReportsAddType::class, $transactions);

        if ($this->saveChanges($form, $request, $transactions)) {
            $this->addFlash(
                'notice',
                'Transaction Edited'
            );
            return $this->redirectToRoute('transaction_list');
        }

        return $this->render('transaction/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
