<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Commentaire;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }


    /**
 * @Route("/add-post", name="add_post")
 * @return Response
 */
public function addPost(Request $request, EntityManagerInterface $manager)
{
    $post = new Post();
    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
        
       
        $manager->persist($post);
        $manager->flush();
        return $this->redirectToRoute("blogg");
    }

    return $this->render("addpost.html.twig", [
        
        "form" => $form->createView(),
    ]);
}

/**
 * @Route("/addpost", name="addpost")
 * @return Response
 */
public function addPostt(Request $request, EntityManagerInterface $manager)
{
    $post = new Post();
    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
       
        $manager->persist($post);
        $manager->flush();
        return $this->redirectToRoute("backpost");
    }

    return $this->render("addposttt.html.twig", [
        
        "form" => $form->createView(),
    ]);
}

/**
 * @Route("/modify-post/{id}", name="modify_post")
 * @return Response
 */
public function modifyPost(Request $request,Post $post  ,EntityManagerInterface $manager)

{

   $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {    
        $manager->persist($post);
        $manager->flush();
        return $this->redirectToRoute("blogg");

    }
   

    return $this->render("modifypost.html.twig", [
      
        "form" => $form->createView(),
        'post' => $post
    ]);
   
}

/**
 * @Route("/modifpost/{id}", name="modifpost")
 * @return Response
 */
public function modifPost(Request $request,Post $post  ,EntityManagerInterface $manager)

{

   $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {    
        $manager->persist($post);
        $manager->flush();
        return $this->redirectToRoute("backpost");

    }
   

    return $this->render("modifypost.html.twig", [
      
        "form" => $form->createView(),
        'post' => $post
    ]);
   
}
/**
 * @Route("/delete-post/{id}", name="delete_post")
 */
public function delPost(int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $post = $entityManager->getRepository(Post::class)->find($id);
    $entityManager->remove($post);
    $entityManager->flush();

    return $this->redirectToRoute("blogg");
}






/**
 * @Route("/supppost/{id}", name="supppost")
 */
public function deletePost(int $id, PostRepository $rep, EntityManagerInterface $em): Response
{
    $post = $rep->find($id);
    $em->remove($post);
    $em->flush();
    return $this->redirectToRoute('backpost');
}



/**
 * @Route("/post", name="post")
 */
public function post()
{
    $post = $this->getDoctrine()->getRepository(Post::class)->findAll();

    return $this->render('blog.html.twig', [
        "post" => $post,
    ]);
}


/**
 * @Route("/post/{id}", name="post")
 */
public function postt(int $id): Response
{
    $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

    return $this->render("comm.html.twig", [
        "post" => $post
    ]);
}



/**
 * Undocumented function
 * @Route("blogg" , name="blogg")
 * 
 */
public function showcomm(PostRepository $post, CommentaireRepository $comm): Response 
{
   $posts = $post->findAll();
   $comms = $comm->findAll();

   return $this->render("forum.html.twig",[
    'posts' => $posts,
    'comms' => $comms
   ]);

   

  

}
/**
 * Undocumented function
 * @Route("showsupp" , name="postsupp")
 * 
 */
public function showsuppost(PostRepository $post, CommentaireRepository $comm): Response 
{
   $posts = $post->findAll();
   $comms = $comm->findAll();

   return $this->render("forum.html.twig",[
    'posts' => $posts,
    'comms' => $comms
   ]);

}

/**
 * Undocumented function
 * @Route("backpost" , name="backpost")
 * 
 */
public function showInscri(PostRepository $post): Response 
{
   $posts = $post->findAll();

   return $this->render("tablepost.html.twig",[
    'posts' => $posts
   ]);

}


}
