<?php

namespace App\Controller;

use App\Entity\Tournoi;
use App\Form\TournoiFormType;
use App\Repository\TournoiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TournoiController extends AbstractController
{
   /**
     * @Route("/tournoi", name="tournoi")
     */
    public function index(): Response
    {
        return $this->render('tournoi/index.html.twig', [
            'controller_name' => 'TournoiController',
        ]);
    }

    /**
     * @Route("/tournoi", name="tournoi_back")
     */
    public function Tournoi()
    {

        $tournoi = $this->getDoctrine()->getRepository(Tournoi::class)->findAll();
        return $this->render('tournoi/index.html.twig', [
            'tournoi' => $tournoi
        ]);
    }

    
    /**
     * @Route("/tournoiback", name="tournoiback")
     */
    public function tournoiback(): Response
    {
        return $this->render('tournoi/tournoiback.html.twig');
    }


    /**
* @Route("/add-tournoi", name="tournoi_register")
* @return Response 
*/
public function addTournoi(Request $request , EntityManagerInterface $manager)
{
  $tournoi = new Tournoi();
  $form = $this->createForm(TournoiFormType::class, $tournoi);
  $form->handleRequest($request);

  if($form->isSubmitted() && $form->isValid())
  {
      $manager->persist($tournoi);
      $manager->flush();
  }

  return $this->render("tournoi/tournoiback.html.twig", [
      "form" => $form->createView(),
  ]);
}



    

/**
 * @Route("/modify-tournoi/{id}", name="modify_tournoi")
 * @return Response
 */
public function modifyTournoi(Request $request, Tournoi $tournois  ,EntityManagerInterface $manager)

{

   $form = $this->createForm(TournoiFormType::class, $tournois);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {    
        $manager->persist($tournois);
        $manager->flush();
        return $this->redirectToRoute("tournoisupp");

    }

    return $this->render("tournoi/modify-tournoi.html.twig", [
      
        "form" => $form->createView(),
        'tournoi' => $tournois
    ]);
}


/**
 * @Route("/delete-tournoi/{id}", name="delete_tournoi")
 */
public function deleteTournoi(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $tournoi = $entityManager->getRepository(Tournoi::class)->find($id);
    $entityManager->remove($tournoi);
    $entityManager->flush();

    return $this->redirectToRoute("tournoisupp");
}





/**
 * Undocumented function
 * @Route("tournoi_show" , name="tournoi-show")
 * 
 */
public function showTournoi(TournoiRepository $tournoi): Response 
{
   $tournois = $tournoi->findAll();

   return $this->render("tables.html.twig",[
    'tournois' => $tournois
   ]);

}

/**
 * Undocumented function
 * @Route("tournoifront" , name="tournoifront")
 * 
 */
public function showTournoii(TournoiRepository $tour): Response 
{
   $tournois = $tour->findAll();

   return $this->render("tournoi/index.html.twig",[
    'tournois' => $tournois
   ]);

}

/**
 * Undocumented function
 * @Route("tournoishowsupp" , name="tournoisupp")
 * 
 */
public function deletetournoii(TournoiRepository $tournoi): Response 
{
   $tournois = $tournoi->findAll();

   return $this->render("tables.html.twig",[
    'tournois' => $tournois
   ]);

}
 
/**
     * @Route("/stat", name="stats")
     */

public function stat(TournoiRepository $tourepos): Response
{
    $tournoi = $tourepos->findAll();

    $tourNom = [];
    $tourColor = [];
    $tourJeux = [];
    

    foreach($tournoi as $tournois){
        $tourJeux[] = $tournois->getJeux();
        $tourColor[] = $tournois->getCouleur();
        $tourNom[] = count(array($tournois->getNomTournoi()));
        
    }

    return $this->render('stat.html.twig',[
        'tourNom' => json_encode($tourNom),
        'tourColor' => json_encode($tourColor),
        'tourJeux' => json_encode($tourJeux)
    ]
            
    );
} 


}