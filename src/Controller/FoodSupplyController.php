<?php

namespace App\Controller;

use App\Entity\FoodSupply;
use App\Form\FoodSupplyAddType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class FoodSupplyController extends AbstractController
{
    /**
     * @Route("/supply", name="supply_list")
     */
    public function list_FoodSupply(): Response
    {
        $supplies = $this->getDoctrine()->getRepository(FoodSupply::class)->findAll();
        return $this->render('food_supply/index.html.twig', [
            'supplies' => $supplies,
        ]);
    }
    /**
     * @Route("/supply/details/{id}", name="supply_details")
     */
    public function food_supply_details($id): Response
    {
        $supplies = $this->getDoctrine()->getRepository(FoodSupply::class)->find($id);
        return $this->render('food_supply/details.html.twig', [
            'supplies' => $supplies,
        ]);
    }
    /**
     * @Route("/supply/delete/{id}", name="supply_delete")
     */
    public function delete_food_supply($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $supplies = $em->getRepository(FoodSupply::class)->find($id);
        $em->remove($supplies);
        $em->flush();

        $this->addFlash(
            'error',
            'Food_Supply deleted'
        );

        return $this->redirectToRoute('supply_list');

    }
    /**
     * @Route("/supply/create", name="supply_create", methods={"GET","POST"})
     */
    public function create_food_supply(Request $request)
    {
        $supplies = new FoodSupply();
        $form = $this->createForm(FoodSupplyAddType::class, $supplies);

        if ($this->saveChanges($form, $request, $supplies)) {
            $this->addFlash(
                'notice',
                'FoodSupply Added'
            );

            return $this->redirectToRoute('supply_list');
        }

        return $this->render('food_supply/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $supplies): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($request->request->get('supply')['name'])) {
                $supplies->setName($request->request->get('supply')['name']);
            }
            if (isset($request->request->get('supply')['quantity_supply'])) {
                $supplies->setDescription($request->request->get('supply')['quantity_supply']);
            }
            if (isset($request->request->get('supply')['date_supply'])) {
                $supplies->set(DateTime::createFromFormat('Y-m-d',$request->request->get('supply')['date_supply']));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($supplies);
            $em->flush();


            return true;
        }
        return false;
    }
    /**
     * @Route("/supply/edit/{id}", name="supply_edit")
     */
    public function edit_food_supply($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $supplies= $em->getRepository(FoodSupply::class)->find($id);
        $form = $this->createForm(FoodSupplyAddType::class, $supplies);

        if ($this->saveChanges($form, $request, $supplies)) {
            $this->addFlash(
                'notice',
                'Food Supply Edited'
            );
            return $this->redirectToRoute('supply_list');
        }

        return $this->render('food_supply/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
