<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actualite;
use App\Repository\ActualiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ActualiteType;

class ActualiteController extends AbstractController
{
    /**
     * @Route("/review", name="review-actualite")
     */
    public function show(ActualiteRepository $act): Response
    {
        $acts = $act->findAll();
        return $this->render('actualite/review.html.twig', [
            'acts' => $acts
        ]);
    }

    /**
     * @Route("/", name="recherche")
     */
    public function Search(Request $request, ActualiteRepository $act): Response
    {
        $titre = $request->query->get('rech');

        $acts = $act->findBy(["titre" => $titre]);
        return $this->render('actualite/review.html.twig', [
            'acts' => $acts
        ]);
    }

    /**
     * @Route("/reviewadmin", name="review-actualiteadmin")
     */
    public function showadmin(ActualiteRepository $act): Response
    {
        $acts = $act->findAll();
        return $this->render('actualite/reviewadmin.html.twig', [
            'acts' => $acts
        ]);
    }
    /**
     * @Route("/actualite", name="actualite")
     */
    public function index(): Response
    {

        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
        ]);
    }

    /**
     * @Route("/actualiteback", name="actualiteback")
     */
    public function indexadmin(): Response
    {

        return $this->render('actualite/review.html.twig');
    }

    /**
     * @Route("/add-act", name="newActualite")
     * @return Response
     */

    public function addact(Request $request, EntityManagerInterface $entityManager)
    {

        $actualite = new Actualite();


        $form = $this->createForm(ActualiteType::class, $actualite);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($actualite);
            $entityManager->flush();
            return $this->redirectToRoute('review-actualite', [
                'id' => $actualite->getId()
            ]);
        }

        return $this->render('actualite/register.html.twig', [
            'form' => $form->createView()


        ]);
    }
    /**
     * @Route("/actualite/{id}", name="act_modifier")
     * @return Response
     */
    public function modifier(Request $request, actualite $acts, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ActualiteType::class, $acts);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $a = $this->getDoctrine()->getManager();
            $a->flush();
            $this->addFlash(
                'info',
                'votre actualite  est modifie  !!',
            );
            return $this->redirectToRoute("review-actualite");
        }

        return $this->render("actualite/modifier.html.twig", [
            "form" => $form->CreateView(),
            "actualite" => $acts
        ]);
    }


    /**
     * @Route("/actualite/{id}/supprimer", name="act_delete")
     * @return Response
     */
    public function delete(actualite $acts, EntityManagerInterface $manager)
    {
        $manager->remove($acts);
        $manager->flush();


        return $this->redirectToRoute("review-actualite");
    }
}
