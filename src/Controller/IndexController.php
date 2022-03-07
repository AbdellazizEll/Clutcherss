<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact.html.twig');
    }


    /**
     * @Route("/blog", name="blog")
     */
    public function blog(): Response
    {
        return $this->render('blog.html.twig');
    }

     /**
     * @Route("/games", name="games")
     */
    public function games(): Response
    {
        return $this->render('games.html.twig');
    }

    /**
     * @Route("/game-single", name="game-single")
     */
    public function gamesingle(): Response
    {
        return $this->render('game-single.html.twig');
    }

    /**
     * @Route("/review", name="review")
     */
    public function review(): Response
    {
        return $this->render('review.html.twig');
    }

     /**
     * @Route("/inscri", name="inscri")
     */
    public function inscri(): Response
    {
        return $this->render('inscri.html.twig');
    }

}