<?php

namespace App\Controller;

use App\Entity\Matchh;
use App\Form\MatchhFormType;
use App\Repository\MatchhRepository;
use App\Repository\TournoiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchhController extends AbstractController
{
    /**
     * @Route("/matchh", name="matchh")
     */
    public function index(): Response
    {




        return $this->render('matchh/index.html.twig', [
            'controller_name' => 'MatchhController',
        ]);
    }

    /**
     * @Route("/matchh", name="matchh_back")
     */
    public function matchh()
    {

        $matchh = $this->getDoctrine()->getRepository(Matchh::class)->findAll();
        return $this->render('matchh/index.html.twig', [
            'matchh' => $matchh,
        ]);
    }


    /**
     * @Route("/matchhback", name="matchhback")
     */
    public function matchhback(): Response
    {
        return $this->render('matchh/matchhback.html.twig');
    }


    /**
     * @Route("/add-matchh", name="matchh_register")
     * @return Response 
     */
    public function addmatchh(Request $request, EntityManagerInterface $manager)
    {
        $matchh = new Matchh();
        $form = $this->createForm(MatchhFormType::class, $matchh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($matchh);
            $manager->flush();
        }

        return $this->render("matchh/matchhback.html.twig", [
            "form" => $form->createView(),
        ]);
    }





    /**
     * @Route("/modify-matchh/{id}", name="modify_matchh")
     * @return Response
     */
    public function modifymatchh(Request $request, Matchh $matchhs, EntityManagerInterface $manager)

    {

        $form = $this->createForm(MatchhFormType::class, $matchhs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($matchhs);
            $manager->flush();
            return $this->redirectToRoute("matchhsupp");
        }

        return $this->render("matchh/modify-matchh.html.twig", [

            "form" => $form->createView(),
            'matchh' => $matchhs
        ]);
    }


    /**
     * @Route("/delete-matchh/{id}", name="delete_matchh")
     */
    public function deletematchh(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $matchh = $entityManager->getRepository(Matchh::class)->find($id);
        $entityManager->remove($matchh);
        $entityManager->flush();

        return $this->redirectToRoute("matchhsupp");
    }





    /**
     * Undocumented function
     * @Route("matchh_show" , name="matchh-show")
     * 
     */
    public function showmatchh(MatchhRepository $matchh): Response
    {
        $matchhs = $matchh->findAll();

        return $this->render("tablesmatchh.html.twig", [
            'matchhs' => $matchhs
        ]);
    }

    /**
     * Undocumented function
     * @Route("matchhfront" , name="matchhfront")
     * 
     */
    public function showmatchhi(MatchhRepository $matchh): Response
    {



        $matchhs = $matchh->findAll();

        return $this->render("matchh/index.html.twig", [
            'matchhs' => $matchhs
        ]);
    }

    /**
     * Undocumented function
     * @Route("matchhshowsupp" , name="matchhsupp")
     * 
     */
    public function deletematchhi(MatchhRepository $matchh): Response
    {
        $matchhs = $matchh->findAll();

        return $this->render("tablesmatchh.html.twig", [
            'matchhs' => $matchhs
        ]);
    }

    /**
     * Undocumented function
     * @Route("tournoi_show" , name="tournoi-show")
     * 
     */
    public function showTournoi(TournoiRepository $tournoi): Response
    {
        $tournois = $tournoi->findAll();

        return $this->render("tables.html.twig", [
            'tournois' => $tournois
        ]);
    }
}
