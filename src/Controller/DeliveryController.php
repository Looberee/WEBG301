<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Form\DeliveryAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DeliveryController extends AbstractController
{
    /**
     * @Route("/delivery", name="delivery_list")
     */
    public function list_delivery(): Response
    {
        $deliveries = $this->getDoctrine()->getRepository(Delivery::class)->findAll();
        return $this->render('delivery/index.html.twig', [
            'deliveries' => $deliveries
        ]);
    }
    /**
     * @Route("/delivery/delete/{id}", name="delivery_delete")
     */
    public function delete_deliveries($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $deliveries = $em->getRepository(Delivery::class)->find($id);
        $em->remove($deliveries);
        $em->flush();

        $this->addFlash(
            'error',
            'Delivery deleted'
        );

        return $this->redirectToRoute('delivery_list');

    }
    /**
     * @Route("/delivery/details/{id}", name="delivery_details")
     */
    public function delivery_details($id): Response
    {
        $deliveries = $this->getDoctrine()->getRepository(Delivery::class)->find($id);
        return $this->render('delivery/details.html.twig', [
            'delivery' => $deliveries,
        ]);
    }
    /**
     * @Route("/delivery/create", name="delivery_create", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $deliveries = new Delivery();
        $form = $this->createForm(DeliveryAddType::class, $deliveries);

        if ($this->saveChanges($form, $request, $deliveries)) {
            $this->addFlash(
                'notice',
                'Delivery Added'
            );

            return $this->redirectToRoute('delivery_list');
        }

        return $this->render('delivery/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $deliveries): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($request->request->get('delivery')['date'])) {
                $deliveries->set(\DateTime::createFromFormat('Y-m-d',$request->request->get('delivery')['date']));
            }
            if (isset($request->request->get('delivery')['CustomerID'])) {
                $deliveries->set($request->request->get('order')['CustomerID']);
            }
            if (isset($request->request->get('delivery')['FoodID'])) {
                $deliveries->set($request->request->get('delivery')['FoodID']);
            }
            if (isset($request->request->get('delivery')['Quantities'])) {
                $deliveries->set($request->request->get('delivery')['Quantities']);
            }
            if (isset($request->request->get('delivery')['Payment'])) {
                $deliveries->set($request->request->get('delivery')['Payment']);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($deliveries);
            $em->flush();


            return true;
        }
        return false;
    }
    /**
     * @Route("/delivery/edit/{id}", name="delivery_edit")
     */
    public function edit_delivery($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $deliveries = $em->getRepository(Delivery::class)->find($id);
        $form = $this->createForm(DeliveryAddType::class, $deliveries);

        if ($this->saveChanges($form, $request, $deliveries)) {
            $this->addFlash(
                'notice',
                'Delivery Edited'
            );
            return $this->redirectToRoute('delivery_list');
        }

        return $this->render('delivery/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

