<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Form\JeuType;
use App\Repository\JeuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JeuController extends AbstractController
{


    /**
     * @Route("/jeufront", name="review-jeu")
     */
    public function show(JeuRepository $jeu): Response
    {
        $jeux = $jeu->findAll();
        return $this->render('games.html.twig', [
            'jeux' => $jeux
        ]);
    }


    /**
     * @Route("/jeufrontadmin", name="review-jeuadmin")
     */
    public function showadmin(JeuRepository $jeu): Response
    {
        $jeux = $jeu->findAll();
        return $this->render('jeu/games.html.twig', [
            'jeux' => $jeux
        ]);
    }
    /**
     * @Route("/", name="jeux_front")
     */
    public function jeufront(JeuRepository $rep): Response
    {
        $jeux = $rep->findAll();
        return $this->render('base.html.twig', [
            'jeu' => $jeux,
        ]);
    }



    /**
     * @Route("/jeuback", name="newjeu")
     * @return Response
     */

    public function creategame(Request $request, EntityManagerInterface $entityManager)
    {

        $jeu = new jeu();


        $form = $this->createForm(JeuType::class, $jeu);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($jeu);
            $entityManager->flush();
            return $this->redirectToRoute('review-jeu', [
                'id' => $jeu->getId()
            ]);
        }

        return $this->render('jeu/registergame.html.twig', [
            'form' => $form->createView()


        ]);
    }
    /**
     * @Route("/jeu/{id}/modifier", name="jeu_modifier")
     * @return Response
     */
    public function modifier(Request $request, jeu $acts, EntityManagerInterface $manager)
    {
        $form = $this->createForm(JeuType::class, $acts);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($acts);
            $manager->flush();
            return $this->redirectToRoute("review-jeu");
        }

        return $this->render("jeu/registergame.html.twig", [
            "form" => $form->CreateView(),
            "jeu" => $acts
        ]);
    }


    /**
     * @Route("/jeu/{id}/supprimer", name="jeu_delete")
     * @return Response
     */
    public function delete(jeu $acts, EntityManagerInterface $manager)
    {
        $manager->remove($acts);
        $manager->flush();


        return $this->redirectToRoute("review-jeu");
    }
}
