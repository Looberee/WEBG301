<?php

namespace App\Controller;

use App\Entity\Delivery;
use App\Entity\Order;
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
        $delivery = $em->getRepository(Delivery::class)->find($id);
        $em->remove($delivery);
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
            'deliveries' => $deliveries,
        ]);
    }
    /**
     * @Route("/delivery/create", name="delivery_create", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $delivery = new Delivery();
        $form = $this->createForm(DeliveryAddType::class, $delivery);

        if ($this->saveChanges($form, $request, $delivery)) {
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

    public function saveChanges($form, $request, $delivery): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($request->request->get('delivery')['date'])) {
                $delivery->set(\DateTime::createFromFormat('Y-m-d',$request->request->get('delivery')['date']));
            }
            if (isset($request->request->get('delivery')['CustomerID'])) {
                $delivery->set($request->request->get('order')['CustomerID']);
            }
            if (isset($request->request->get('delivery')['FoodID'])) {
                $delivery->set($request->request->get('delivery')['FoodID']);
            }
            if (isset($request->request->get('delivery')['Quantities'])) {
                $delivery->set($request->request->get('delivery')['Quantities']);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($delivery);
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
        $delivery = $em->getRepository(Delivery::class)->find($id);
        $form = $this->createForm(DeliveryAddType::class, $delivery);

        if ($this->saveChanges($form, $request, $delivery)) {
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

