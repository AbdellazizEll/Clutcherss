<?php


namespace App\Controller;

use App\Entity\User;
use App\Security\EmailVerifier;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurApiController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/mobile/login_mobile", name="login_mobile")
     */
    public function login_mobile(Request $request, UserPasswordEncoderInterface $encoder)
    {

        $email = $request->query->get('username');
        $password = $request->query->get('password');

        $em = $this->getDoctrine()->getManager();

        $user =   $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(array('email' => $email));
        $prd = array();
        if ($user) {
            $passwordValid = $encoder->isPasswordValid($user, $password);
            if ($passwordValid) {
                $prd = array(
                    'id' => $user->getId(),
                    'firstName' => $user->getFirstName(),
                    'password' => $user->getPassword(),
                    'email' => $user->getEmail(),
                    'role' => $user->getRoles(),
                    'picture' => $user->getPicture(),
                    'lastName' => $user->getLastName()

                );
            }
        }

        return new JsonResponse($prd);
    }





    /**
     * @Route("/mobile/inscrireMobile", name="inscrireMobile")
     */
    public function inscrireMobile(UserPasswordEncoderInterface $userPasswordEncoder, Request $request)
    {

        $firstName = $request->query->get('firstName');
        $lastName = $request->query->get('lastName');
        $email = $request->query->get('email');
        $password = $request->query->get('password');
        $picture = $request->query->get('picture');


        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);





        $destinationfile = md5(uniqid()) . ".png";
        $destination = $this->getParameter('images_directory') .  $destinationfile;

        copy($picture, $destination);

        $user->setPicture($destinationfile);

        $user->setPassword($password);
        $user->setPassword(
            $userPasswordEncoder->encodePassword(
                $user,
                $password
            )
        );

        $user->setIsVerified(md5(uniqid()));

        $em = $this->getDoctrine()->getManager();


        try {
            $em->persist($user);
            $em->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('abdellaziz.elloumi@esprit.tn', 'ellouminatibot'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

        } catch (\Exception $ex) {
            die($ex);
            $data = [
                'title' => 'validation error',
                'message' => 'Some thing went Wrong',
                'errors' => $ex->getMessage()
            ];
            $response = new JsonResponse($data, 400);
            return $response;
        }

        return $this->json(array('title' => 'successful', 'message' => "utilisateur ajouté avec succès"), 200);
    }


    /**
     * @Route("/mobile/getAllUsers", name="getAllUsers")
     */
    public  function getAllUsers()
    {;
        $em = $this->getDoctrine()->getManager();

        $users =   $this->getDoctrine()->getManager()->getRepository(User::class)->findAll();
        $jsonData = array();
        $prd = array();
        $i = 0;
        foreach ($users as $user) {

            $prd = array(
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getFirstName(),

                'password' => $user->getPassword(),
                'email' => $user->getEmail(),
                'role' => $user->getRoles()

            );
            $jsonData[$i++] = $prd;
        }


        return new JsonResponse($jsonData);
    }

    /**
     * @Route("/mobile/getUserByEmail/{email}", name="getUserByEmail")
     */
    public function getUserByEmail($email)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(array('email' => $email));
        $prd = array();
        if ($user) {
            $prd = array(
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'role' => $user->getRoles(),
                'picture' => $user->getPicture()

            );
        }

        return new JsonResponse($prd);
    }

    /**
     * @Route("/mobile/removeUser/{email}", name="removeUser")
     */
    public function removeUser($email)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(array('email' => $email));

        $em->remove($user);
        $em->flush();
        return $this->json(array('title' => 'successful', 'message' => "utilisateur supprimé avec succès"), 200);
    }
}
