<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="reclamation")
     */
    public function index(ReclamationRepository $req): Response
    {
        $reclamation = $req->findAll();
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
            'data' => $reclamation
        ]);
    }


    /**
     * @param Request $request 
     * @return RedirectResponse
     * @Route("/contact_us" , name="contact_us")
     */

    public function CreateReclamation(Request $request, EntityManagerInterface $entityManager, ReclamationRepository $rec): Response
    {

        $reclamation = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamation);
        //$form->add('Envoyer' , SubmitType::class);
        $form->handleRequest($request);
        $reclamation->setUser($this->getUser());

        if ($form->isSubmitted() && $form->isValid()) {

            $reclamation->setStatut(false);
            $entityManager->persist($reclamation);
            $entityManager->flush();
            return $this->redirectToRoute('contact_us');
        }

        return $this->render('reclamation/register.html.twig', [
            'fadd' => $form->createView(),
            'rec' => $reclamation,
        ]);
    }



    /**
     * @Route("/reclamation_delete/{id}" , name ="reclamation_d")
     */

    public function delete($id, ReclamationRepository $rep, EntityManagerInterface $em)
    {
        $rec = $rep->find($id);
        $em->remove($rec);
        $em->flush();
        return $this->redirectToRoute('reclamation');
    }
}
