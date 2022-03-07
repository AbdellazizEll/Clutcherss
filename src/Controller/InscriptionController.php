<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\InscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

  


/**
 * @Route("/add-inscri", name="add_inscri")
 * @return Response
 */
public function addInscri(Request $request, EntityManagerInterface $manager)
{
    $inscri = new Inscription();
    $form = $this->createForm(InscriptionType::class, $inscri);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
       
        $manager->persist($inscri);
        $manager->flush();
        return $this->redirectToRoute("add_inscri");
    }

    return $this->render("inscri.html.twig", [
        
        "form" => $form->createView(),
    ]);
}


/**
 * @Route("/addinscri", name="addinscri")
 * @return Response
 */
public function addInscrii(Request $request, EntityManagerInterface $manager)
{
    $inscri = new Inscription();
    $form = $this->createForm(InscriptionType::class, $inscri);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
       
        $manager->persist($inscri);
        $manager->flush();
        return $this->redirectToRoute("inscription_show");
    }

    return $this->render("addinscri.html.twig", [
        
        "form" => $form->createView(),
    ]);
}

/**
 * @Route("/modify-inscri/{id}", name="modify_inscription")
 * @return Response
 */
public function modifyInscription(Request $request,Inscription $inscription  ,EntityManagerInterface $manager)

{

   $form = $this->createForm(InscriptionType::class, $inscription);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {    
        $manager->persist($inscription);
        $manager->flush();
        return $this->redirectToRoute("inscription_show");

    }
   

    return $this->render("modifyinscri.html.twig", [
      
        "form" => $form->createView(),
        'inscription' => $inscription
    ]);
   
}


/**
 * @Route("/delete-inscription/{id}", name="delete_inscription")
 */
public function deleteInscription(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $inscription = $entityManager->getRepository(Inscription::class)->find($id);
    $entityManager->remove($inscription);
    $entityManager->flush();

    return $this->redirectToRoute("inscriptionsupp");
}


/**
 * @Route("/inscri", name="inscri")
 */
public function inscriptionn()
{
    $inscri = $this->getDoctrine()->getRepository(Inscription::class)->findAll();

    return $this->render('inscri.html.twig', [
        "inscri" => $inscri,
    ]);
}


/**
 * @Route("/inscri/{id}", name="inscri")
 */
public function inscri(int $id): Response
{
    $inscri = $this->getDoctrine()->getRepository(Inscription::class)->find($id);

    return $this->render("inscri.html.twig", [
        "inscri" => $inscri
    ]);
}



/**
 * Undocumented function
 * @Route("register_show" , name="inscription_show")
 * 
 */
public function showInscri(InscriptionRepository $insc): Response 
{
   $inscriptions = $insc->findAll();

   return $this->render("tables.html.twig",[
    'inscriptions' => $inscriptions
   ]);

}

/**
 * Undocumented function
 * @Route("inscrishowsupp" , name="inscriptionsupp")
 * 
 */
public function showInscrii(InscriptionRepository $insc): Response 
{
   $inscriptions = $insc->findAll();

   return $this->render("tables.html.twig",[
    'inscriptions' => $inscriptions
   ]);

}



}