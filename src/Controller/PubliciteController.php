<?php

namespace App\Controller;

use App\Entity\Publicite;
use App\Form\PubliciteFormType;
use App\Repository\PubliciteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PubliciteController extends AbstractController
{
    /**
     * @Route("/publicite", name="publicite")
     */
    public function index(): Response
    {
        return $this->render('publicite/index.html.twig', [
            'controller_name' => 'PubliciteController',
        ]);
    }


    /**
     * @Route("/add-pub", name="add_pub")
     * @return Response
     */
    public function addpub(Request $request, EntityManagerInterface $manager)
    {
        $pub = new Publicite();
        $form = $this->createForm(PubliciteFormType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($pub);
            $manager->flush();
            return $this->redirectToRoute("pubshow");
        }

        return $this->render("publicite.html.twig", [

            "form" => $form->createView(),
        ]);
    }



    /**
     * @Route("/modify-pub/{id}", name="modify_pub")
     * @return Response
     */
    public function modifyInscription(Request $request, Publicite $pub, EntityManagerInterface $manager)

    {

        $form = $this->createForm(PubliciteFormType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($pub);
            $manager->flush();
            return $this->redirectToRoute("pubshow");
        }


        return $this->render("modifypub.html.twig", [

            "form" => $form->createView(),
            'pub' => $pub
        ]);
    }


    /**
     * @Route("/delete-pub/{id}", name="delete_pub")
     */
    public function deletepub(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pub = $entityManager->getRepository(Publicite::class)->find($id);
        $entityManager->remove($pub);
        $entityManager->flush();

        return $this->redirectToRoute("pubsupp");
    }
    /**
     * @Route("/publicite", name="publiciteback")
     */
    public function pubs()
    {
        $pub = $this->getDoctrine()->getRepository(Publicite::class)->findAll();

        return $this->render('publicite/publicite.html.twig', [
            "pub" => $pub,
        ]);
    }


    /**
     * @Route("/publicite/{id}", name="publicite")
     */
    public function publicite(int $id): Response
    {
        $pub = $this->getDoctrine()->getRepository(Publicite::class)->find($id);

        return $this->render("publicite.html.twig", [
            "pub" => $pub
        ]);
    }



    /**
     * Undocumented function
     * @Route("pubshow" , name="pubs_show")
     * 
     */
    public function showpub(PubliciteRepository $pub): Response
    {
        $pubs = $pub->findAll();

        return $this->render("base.html.twig", [
            'pubs' => $pubs
        ]);
    }



    /**
     * Undocumented function
     * @Route("/showpub" , name="pubs_showfront")
     * 
     */
    public function showpubb(PubliciteRepository $pub): Response
    {
        $pubs = $pub->findAll();

        return $this->render("base.html.twig", [
            'pubs' => $pubs
        ]);
    }

    /**
     * Undocumented function
     * @Route("/pubshowsupp" , name="pubsupp")
     * 
     */
    public function showInscrii(PubliciteRepository $pub): Response
    {
        $pubs = $pub->findAll();

        return $this->render("tablespublicite.html.twig", [
            'pubs' => $pubs
        ]);
    }
}
