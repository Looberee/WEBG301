<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customer", name="customer_list")
     */
    public function list_customer(): Response
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->findAll();
        return $this->render('customer/index.html.twig', [
            'customers' => $customers,
        ]);
    }
    /**
     * @Route("/customer/details/{id}", name="customer_details")
     */
    public function customer_details($id): Response
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)->find($id);
        return $this->render('customer/details.html.twig', [
            'customers' => $customers,
        ]);
    }
    /**
     * @Route("/customer/delete/{id}", name="customer_delete")
     */
    public function delete($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository(Customer::class)->find($id);
        $em->remove($customer);
        $em->flush();

        $this->addFlash(
            'error',
            'Customer deleted'
        );

        return $this->redirectToRoute('customer_list');

    }
    /**
     * @Route("/customer/create", name="customer_create", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerAddType::class, $customer);

        if ($this->saveChanges($form, $request, $customer)) {
            $this->addFlash(
                'notice',
                'Customer Added'
            );

            return $this->redirectToRoute('customer_list');
        }

        return $this->render('customer/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $customer): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($request->request->get('customer')['name'])) {
                $customer->setName($request->request->get('customer')['name']);
            }
            if (isset($request->request->get('customer')['phone'])) {
                $customer->setDescription($request->request->get('customer')['phone']);
            }
            if (isset($request->request->get('customer')['gender'])) {
                $customer->setDescription($request->request->get('customer')['gender']);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();


            return true;
        }
        return false;
    }
    /**
     * @Route("/customer/edit/{id}", name="customer_edit")
     */
    public function edit($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $customer = $em->getRepository(Customer::class)->find($id);
        $form = $this->createForm(CustomerAddType::class, $customer);

        if ($this->saveChanges($form, $request, $customer)) {
            $this->addFlash(
                'notice',
                'Customer Edited'
            );
            return $this->redirectToRoute('customer_list');
        }

        return $this->render('customer/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

}