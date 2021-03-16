<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        $userExist = '';
        $get_email = null;

        if ($form->isSubmitted() && $form->isValid()) {

            $get_email = $this->getDoctrine()->getRepository(User::class)->findBy(array('email' => $user->getEmail()));

            if (!$get_email) {
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
                $user->setUsername($user->getUsername());  
                $roles = ["ROLE_USUARIO"];
                $user->setRoles($roles);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_login');
            } else{
                $userExist = 'Ese email ya esta registrado';
            }
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'get_email' => $get_email,
            'userExist' => $userExist
        ]);
    }
}
