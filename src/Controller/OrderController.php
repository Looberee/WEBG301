<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order_list")
     */
    public function list_order(): Response
    {
        $orders = $this->getDoctrine()->getRepository(Order::class)->findAll();
        return $this->render('order/index.html.twig', [
            'orders' => $orders,
        ]);
    }
    /**
     * @Route("/order/delete/{id}", name="order_delete")
     */
    public function delete_orders($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository(Order::class)->find($id);
        $em->remove($order);
        $em->flush();

        $this->addFlash(
            'error',
            'Order deleted'
        );

        return $this->redirectToRoute('order_list');

    }
    /**
     * @Route("/order/details/{id}", name="order_details")
     */
    public function customer_details($id): Response
    {
        $orders = $this->getDoctrine()->getRepository(Order::class)->find($id);
        return $this->render('order/details.html.twig', [
            'orders' => $orders,
        ]);
    }
    /**
     * @Route("/order/create", name="order_create", methods={"GET","POST"})
     */
    public function create(Request $request)
    {
        $order = new Order();
        $form = $this->createForm(OrderAddType::class, $order);

        if ($this->saveChanges($form, $request, $order)) {
            $this->addFlash(
                'notice',
                'Order Added'
            );

            return $this->redirectToRoute('order_list');
        }

        return $this->render('order/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $order): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($request->request->get('order')['date'])) {
                $order->setName(\DateTime::createFromFormat('Y-m-d',$request->request->get('order')['date']));
            }
            if (isset($request->request->get('order')['CustomerID'])) {
                $order->setName($request->request->get('order')['CustomerID']);
            }
            if (isset($request->request->get('order')['FoodID'])) {
                $order->setName($request->request->get('order')['FoodID']);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();


            return true;
        }
        return false;
    }
    /**
     * @Route("/order/edit/{id}", name="order_edit")
     */
    public function edit_order($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository(Order::class)->find($id);
        $form = $this->createForm(OrderAddType::class, $order);

        if ($this->saveChanges($form, $request, $order)) {
            $this->addFlash(
                'notice',
                'Order Edited'
            );
            return $this->redirectToRoute('order_list');
        }

        return $this->render('order/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
