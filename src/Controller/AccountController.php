<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\PasswordUpdateType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{

    /**
     * Permet d'afficher et de traiter le formulaire de modification de profil
     *
     * @Route("/account/profile", name="account_profile")
     * 
     * @return Response
     */
    public function profile(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les données du profil ont été enregistrée avec succès !"
            );
        }


        return $this->render('back/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/users", name="liste_users")
     */
    public function  showusers(UserRepository $repo)
    {

        $user = $repo->findAll();

        return $this->render('back/tables.html.twig', [
            'users' => $user
        ]);
    }



    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/users/{id}/delete", name="user_delete")
     *
     * @param User $user
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(User $user, EntityManagerInterface $manager)
    {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur  <strong>{$user->getFullName()}</strong> a bien été supprimée !"
        );

        return $this->redirectToRoute("liste_users");
    }



    /**
     * Permet de modifier le mot de passe
     *
     * @Route("/account/password-update", name="password-update")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)
    {
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // 1. Vérifier que le oldPassword du formulaire soit le même que le password de l'user
            if (!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())) {
                // Gérer l'erreur
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas votre mot de passe actuel !"));
            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $password = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($password);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié !"
                );

                return $this->redirectToRoute('homepage');
            }
        }


        return $this->render('account/password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le profil de l'utilisateur connecté
     * 
     * @Route("/account" , name="account_index")
     * IsGranted("ROLE_USER")
     * 
     * @return Response 
     */

    public function myAccount()
    {

        return $this->render('user/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}
