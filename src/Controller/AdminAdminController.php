<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;

class AdminAdminController extends AbstractController
{
    /**
     * @Route ("/admin/admins", name="admin_list_admins")
     */

    public function listAdmin(UserRepository $userRepository){
        $admins = $userRepository->findAll();

        return $this->render('admin/admins.html.twig', [
            'admins'=> $admins
        ]);
    }
// Création d'une route suivi d'une méthode qui permet d'afficher la liste des Admins, en utilisant la fonction findAll
// qui vient d'une instance de la classe UserRepository

    /**
     * @Route("/admin/create", name="admin_create_admin")
     */

    public function createAdmin(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher){
        // On déclare créer une nouvelle entrée dans la table user
        $user = new User();
        // On utilise le setter pour attribuer le rôle admin à notre nouvelle entrée
        $user->setRoles(["ROLE_ADMIN"]);

        //creatiopn du formulaire d'après le gabarit UserType (UserType créé avec le terminal make form)
        $form = $this->createForm(UserType::class, $user);
        // handleRequest, permis par l'instance de la classe Request: Permet de récuperer dans une variable $form,
        // les valeurs entrée dans les champs du formulaire
        $form->handleRequest($request);

        // Condition qui permet de savoir j'ai bien soumis les champs à mon formulaire et qu'ils sont valide
        if ($form->isSubmitted() && $form->isValid()){
            // récuparation des données dans le champ "password" pour les stocker dans la variable $plainPassword
            $plainPassword = $form->get('password')->getData();
            // En utilisant la fonction hashPassword permise par l'intance de classe $userPasswordHasher
            // on crypte le MDP contenu dans $plainPassword qu'on vient ensuite stocker dans une variable $hashedPassword
            $hashedPassword = $userPasswordHasher->hashPassword($user, $plainPassword);

            // On utilise le setter de $user pour définir le MDP en utilsant celui
            // qui est contenu dans dans $hashedPassword
            $user->setPassword($hashedPassword);

            // On enregister et on fais l'inscription en BDD
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'JP créé. JP content');

            return $this ->redirectToRoute("admin_list_admins");
        }
        // J'envoie le contenu de la variable form dans mon twig pour pouvoir y afficher le formulaire
        return $this->render('admin/insert_admin.html.twig', [
            'form' =>$form->createView()
        ]);

    }
}