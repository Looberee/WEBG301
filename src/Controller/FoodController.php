<?php

namespace App\Controller;

use App\Entity\Food;
use App\Form\FoodAddType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * @Route("/food", name="food_list")
     */
    public function listFood(): Response
    {
        $foods = $this->getDoctrine()->getRepository(Food::class)->findAll();
        return $this->render('food/index.html.twig', [
            'foods' => $foods,
        ]);
    }

    /**
     * @Route("/food/details/{id}", name="food_details")
     */
    public function details($id): Response
    {
        $foods = $this->getDoctrine()->getRepository(Food::class)->find($id);
        return $this->render('food/details.html.twig', [
            'foods' => $foods,
        ]);
    }

    /**
     * @Route("/food/delete/{id}", name="food_delete")
     */
    public function delete($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $food = $em->getRepository(Food::class)->find($id);
        $em->remove($food);
        $em->flush();

        $this->addFlash(
            'error',
            'Food deleted'
        );

        return $this->redirectToRoute('food_list');

    }

    /**
     * @Route("/food/create", name="food_create", methods={"GET","POST"})
     */
    public function createAction(Request $request)
    {
        $food = new Food();
        $form = $this->createForm(FoodAddType::class, $food);

        if ($this->saveChanges($form, $request, $food)) {
            $this->addFlash(
                'notice',
                'Food Added'
            );

            return $this->redirectToRoute('food_list');
        }

        return $this->render('food/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function saveChanges($form, $request, $food): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($request->request->get('food')['name'])) {
                $food->setName($request->request->get('food')['name']);
            }
            if (isset($request->request->get('food')['description'])) {
                $food->setDescription($request->request->get('food')['description']);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($food);
            $em->flush();


            return true;
        }
        return false;
    }
    /**
     * @Route("/food/edit/{id}", name="food_edit")
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $food = $em->getRepository(Food::class)->find($id);
        $form = $this->createForm(FoodAddType::class, $food);

        if ($this->saveChanges($form, $request, $food)) {
            $this->addFlash(
                'notice',
                'Food Edited'
            );
            return $this->redirectToRoute('food_list');
        }

        return $this->render('food/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
