<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Form\CommandesFormType;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;






class CommandesController extends AbstractController
{
    /**
     * @Route("/commandes", name="commandes")
     */
    public function index(): Response
    {



        return $this->render('commandes/index.html.twig', [
            'controller_name' => 'CommandesController',
        ]);
    }



    /**
     * @Route("/add-commandes", name="add_commandes")
     * @return Response
     */
    public function addCommandes(Request $request, EntityManagerInterface $manager)
    {
        $commandes = new Commandes();
        $form = $this->createForm(CommandesFormType::class, $commandes);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($commandes);
            $manager->flush();

            return $this->redirectToRoute("Commandes_show");
        }

        return $this->render("commandes/commandes.html.twig", [

            "form" => $form->createView(),
        ]);
    }


    /**
     * @Route("/modify-cmd/{id}", name="modify_cmd")
     * @return Response
     */
    public function modifyCommandes(Request $request, Commandes $cmd, EntityManagerInterface $manager)

    {

        $form = $this->createForm(CommandesFormType::class, $cmd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($cmd);
            $manager->flush();
            return $this->redirectToRoute("Commandes_show");
        }


        return $this->render("commandes/modifycmde.html.twig", [

            "form" => $form->createView(),
            'cmd' => $cmd
        ]);
    }


    /**
     * @Route("/delete-cmd/{id}", name="delete_cmd")
     */
    public function deletecmde(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $cmd = $entityManager->getRepository(Commandes::class)->find($id);
        $entityManager->remove($cmd);
        $entityManager->flush();

        return $this->redirectToRoute("cmdsupp");
    }


    /**
     * @Route("/commandes", name="commandes")
     */
    public function commandess()
    {
        $commandes = $this->getDoctrine()->getRepository(Commandes::class)->findAll();

        return $this->render('commandes/commandes.html.twig', [
            "commandes" => $commandes,
        ]);
    }


    /**
     * @Route("/commandes/{id}", name="commandes")
     */
    public function commandes(int $id): Response
    {
        $commandes = $this->getDoctrine()->getRepository(Commandes::class)->find($id);

        return $this->render("commandes/commandes.html.twig", [
            "commandes" => $commandes
        ]);
    }



    /**
     * Undocumented function
     * @Route("cmdeshow" , name="Commandes_show")
     * 
     */
    public function showcommandes(CommandesRepository $commande): Response
    {
        $commandes = $commande->findAll();

        return $this->render("commandes/tablescommandes.html.twig", [
            'commandes' => $commandes
        ]);
    }


    /**
     * Undocumented function
     * @Route("cmdshowsupp" , name="cmdsupp")
     * 
     */
    public function showcmdes(CommandesRepository $commande): Response
    {
        $commandes = $commande->findAll();

        return $this->render("commandes/tablescommandes.html.twig", [
            'commandes' => $commandes
        ]);
    }
}
