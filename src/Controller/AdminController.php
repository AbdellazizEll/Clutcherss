<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_account_login")
     * 
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('back/sign-in.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * Permet de se déconnecter
     * 
     * @Route("/admin/logout", name="admin_account_logout")
     *
     * @return void
     */
    public function logout()
    {
        // ...
    }
    /**
     * @Route("/admin/login", name="admin_account_login")
     */
    public function loginAdmin()
    {
        return $this->render('back/sign-in.html.twig');
    }


    /**
     * @Route("/admin/dashboard", name="dashboard")
     */
    public function dashboard(): Response
    {
        return $this->render('back/dashboard.html.twig');
    }

    /**
     * @Route("/admin/indexback", name="indexback")
     */
    public function index(): Response
    {
        return $this->render('back/indexback.html.twig', []);
    }

    /**
     * @Route("/admin/billing", name="billing")
     */
    public function billing(): Response
    {
        return $this->render('back/billing.html.twig');
    }




    public function tables(): Response
    {
        return $this->render('back/tables.html.twig');
    }

    /**
     * @Route("/notifications", name="notifications")
     */
    public function notifications(): Response
    {
        return $this->render('back/notifications.html.twig');
    }


    public function signin(): Response
    {
        return $this->render('back/sign-in.html.twig');
    }


    public function signup(): Response
    {
        return $this->render('back/sign-up.html.twig');
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(): Response
    {
        return $this->render('back/profile.html.twig');
    }
    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/admin/{id}/delete", name="user_delete")
     * @Security("is_granted('ROLE_USER') ", message="Vous n'avez pas le droit d'accéder à cette ressource")
     *
     * @param User $user
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(User  $user, EntityManagerInterface $manager)
    {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'annonce <strong>{$user->getFullName()}</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute("tables");
    }
}
