<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Post;
use App\Form\CommentaireType;
use App\Repository\CommentaireRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="commentaire")
     */
    public function index(): Response
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }


/**
 * @Route("/add-comm", name="add_comm")
 * @return Response
 */
public function addComm(Request $request, EntityManagerInterface $manager)
{
    $comm = new Commentaire();
    $form = $this->createForm(CommentaireType::class, $comm);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
       
        $manager->persist($comm);
        $manager->flush();
        return $this->redirectToRoute("blogg");
    }

    return $this->render("addcomment.html.twig", [
        
        "form" => $form->createView(),
    ]);
}



/**
 * @Route("/addcomm", name="addcomm")
 * @return Response
 */
public function addCommm(Request $request, EntityManagerInterface $manager)
{
    $comm = new Commentaire();
    $form = $this->createForm(CommentaireType::class, $comm);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
       
        $manager->persist($comm);
        $manager->flush();
        return $this->redirectToRoute("backcomm");
    }

    return $this->render("addcomm.html.twig", [
        
        "form" => $form->createView(),
    ]);
}

/**
 * @Route("/modify-comm/{id}", name="modify_comm")
 * @return Response
 */
public function modifycomm(Request $request,Commentaire $comm  ,EntityManagerInterface $manager)

{

   $form = $this->createForm(CommentaireType::class, $comm);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {    
        $manager->persist($comm);
        $manager->flush();
        return $this->redirectToRoute("blogg");

    }
}

    
/**
 * @Route("/modifcomm/{id}", name="modifcomm")
 * @return Response
 */
public function modifcomm(Request $request,Commentaire $comm  ,EntityManagerInterface $manager)

{

   $form = $this->createForm(CommentaireType::class, $comm);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {    
        $manager->persist($comm);
        $manager->flush();
        return $this->redirectToRoute("backcomm");

    }
   

    return $this->render("modifycomm.html.twig", [
      
        "form" => $form->createView(),
        'comm' => $comm
    ]);
   

   

    return $this->render("modifycomm.html.twig", [
      
        "form" => $form->createView(),
        'comm' => $comm
    ]);
   
}


/**
 * @Route("/delete-comm/{id}", name="delete_comm")
 */
public function deleteCommentaire(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $comm = $entityManager->getRepository(Commentaire::class)->find($id);
    $entityManager->remove($comm);
    $entityManager->flush();

    return $this->redirectToRoute("commsupp");
}

/**
 * @Route("/delcomm/{id}", name="delcomm")
 */
public function delCommentaire(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $comm = $entityManager->getRepository(Commentaire::class)->find($id);
    $entityManager->remove($comm);
    $entityManager->flush();

    return $this->redirectToRoute("backcomm");
}


/**
 * @Route("/comm", name="comm")
 */
public function comment()
{
    $comm = $this->getDoctrine()->getRepository(Commentaire::class)->findAll();

    return $this->render('blog.html.twig', [
        "comm" => $comm,
    ]);
}


/**
 * @Route("/comm/{id}", name="comm")
 */
public function comm(int $id): Response
{
    $comm = $this->getDoctrine()->getRepository(Commentaire::class)->find($id);

    return $this->render("comm.html.twig", [
        "comm" => $comm
    ]);
}



/**
 * Undocumented function
 * @Route("backcomm" , name="backcomm")
 * 
 */
public function showcomm(CommentaireRepository $comm): Response 
{
   $comms = $comm->findAll();

   return $this->render("tablecomm.html.twig",[
    'comms' => $comms
   ]);

}

/**
 * Undocumented function
 * @Route("showsup" , name="commsupp")
 * 
 */
public function showsupp(PostRepository $post, CommentaireRepository $comm): Response 
{
   $posts = $post->findAll();
   $comms = $comm->findAll();

   return $this->render("forum.html.twig",[
    'posts' => $posts,
    'comms' => $comms
   ]);

}




}
