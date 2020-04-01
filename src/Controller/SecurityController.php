<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form_register = $this->createForm(RegistrationType::class, $user); //Création du form Symfony à partir de la classe

        $form_register->handleRequest($request);

        
        $form = $this->createFormBuilder()
        ->add('search', TextType::class)
        ->add('send', SubmitType::class, ['label' => 'Rechercher'])
        ->getForm();
        
        if ($form_register->isSubmitted() && $form_register->isValid())
        {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            //Encodage du mot de passe pour le hacher...
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->render('security/login.html.twig', [
                'message' => 'Vous vous êtes bien inscrit sur le site !', 
                'form' => $form->createView()
            ]);
        }

        return $this->render('security/registration.html.twig', [
            'form_register' =>$form_register->createView(),
            'form' =>$form->createView() //Affichage du form Symfony
        ]);
    }


     /**
     * @Route("/connexion", name="security_login")
     */
    public function login()
    {
        
        $form = $this->createFormBuilder()
        ->add('search', TextType::class)
        ->add('send', SubmitType::class, ['label' => 'Rechercher'])
        ->getForm();
        
        return $this->render('security/login.html.twig', ['form' => $form->createView(), 'message'=>'']);
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
        //On a besoin de rien mettre puisqu'il n'est pas réellement utilise d'ajouter un return, mais c'est important d'avoir la fonction !
    }
}