<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\EquipeFormType;
use App\Entity\Equipe;
use App\Repository\EquipeRepository;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="equipe")
     */
    public function index(): Response
    {
        return $this->render('equipe/index.html.twig', [
            'controller_name' => 'EquipeController',
        ]);
    }

    /**
     * @Route("/equipe", name="equipe_back")
     */
    public function equipe()
    {

        $equipe = $this->getDoctrine()->getRepository(Equipe::class)->findAll();
        return $this->render('equipe/index.html.twig', [
            'equipe' => $equipe
        ]);
    }

    
    /**
     * @Route("/equipeback", name="equipeback")
     */
    public function equipeback(): Response
    {
        return $this->render('equipe/equipeback.html.twig');
    }


    /**
* @Route("/add-equipe", name="equipe_register")
* @return Response 
*/
public function addequipe(Request $request , EntityManagerInterface $manager)
{
  $equipe = new Equipe();
  $form = $this->createForm(EquipeFormType::class, $equipe);
  $form->handleRequest($request);

  if($form->isSubmitted() && $form->isValid())
  {
      $manager->persist($equipe);
      $manager->flush();
  }

  return $this->render("equipe/equipeback.html.twig", [
      "form" => $form->createView(),
  ]);
}



    

/**
 * @Route("/modify-equipe/{id}", name="modify_equipe")
 * @return Response
 */
public function modifyequipe(Request $request, Equipe $equipes  ,EntityManagerInterface $manager)

{

   $form = $this->createForm(EquipeFormType::class, $equipes);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {    
        $manager->persist($equipes);
        $manager->flush();
        return $this->redirectToRoute("equipesupp");

    }

    return $this->render("equipe/modify-equipe.html.twig", [
      
        "form" => $form->createView(),
        'equipe' => $equipes
    ]);
}


/**
 * @Route("/delete-equipe/{id}", name="delete_equipe")
 */
public function deleteequipe(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $equipe = $entityManager->getRepository(equipe::class)->find($id);
    $entityManager->remove($equipe);
    $entityManager->flush();

    return $this->redirectToRoute("equipesupp");
}





/**
 * Undocumented function
 * @Route("equipe_show" , name="equipe-show")
 * 
 */
public function showequipe(EquipeRepository $equipe): Response 
{
   $equipes = $equipe->findAll();

   return $this->render("tablesEquipe.html.twig",[
    'equipes' => $equipes
   ]);

}

/**
 * Undocumented function
 * @Route("equipefront" , name="equipefront")
 * 
 */
public function showequipee(EquipeRepository $tour): Response 
{
   $equipes = $tour->findAll();

   return $this->render("equipe/index.html.twig",[
    'equipes' => $equipes
   ]);

}

/**
 * Undocumented function
 * @Route("equipeshowsupp" , name="equipesupp")
 * 
 */
public function deleteequipee(EquipeRepository $equipe): Response 
{
   $equipes = $equipe->findAll();

   return $this->render("tablesEquipe.html.twig",[
    'equipes' => $equipes
   ]);

}





}
