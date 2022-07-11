<?php

namespace App\Controller;
use App\Form\CategoryType;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;



class AdminCategoryController extends AbstractController
{
    //Création de la route (page) qui affiche et gère le formulaire
    /**
     * @Route("/admin/insert-category", name="admin_insert_category")
     */

    // J'ajoute la classe Request et la classe EntityManager dans la méthode pour demander à symfony de les instancier, pour récuperer plus bas
    public function insertCategory (EntityManagerInterface $entityManager)
    {
        $category = new Category();

        // le formulaire est créé et relié au twig ET Type.php et PAF MAGIE
        $form = $this->createForm(CategoryType::class, $category);

        return $this->render("insert_category.html.twig", [
            "form"=>$form->createView()
        ]);





        //    // Le code ne s'éxécute pas grâce au if, ce qui me permet de remplir le formulaire la première fois que la page est chargée
        //        // si le formulaire est rempli, alors la condition sera vraie
        //        // donc le code dans le if s'executera
        //        if ($request->query->has('name_category')) {
        //
        //            // Les request permettent de faire le lien avec les inputs du twig (le nom des "key" y est associé) ce qui permet
        //            // de créer les catégories avce le contenu que l'on veut et non une catégorie avec du code en "dur"
        //            $name_category = $request->query->get('name_category');
        //            $user_color_cat = $request->query->get('user_color_cat');
        //            $user_content = $request->query->get('user_content');
        //
        //
        //            // je créé une instance de la classe Category
        //            // Category c'est une entité, donc quand je créé une instance, c'est pour créer un enregistrement
        //            $category= new Category();
        //
        //            // je défini avec les setters, les valeurs de l'enregistrement
        //            // ici, j'utilise les valeurs du formulaire pour créer l'enregistrement
        //            $category->setTitle($name_category);
        //            $category->setColor($user_color_cat);
        //            $category->setDescription($user_content);
        //            $category->setIsPublished(true);
        //
        //
        //
        //            //        $category = new Category();
        //            //
        //            //        $category->setColor("red");
        //            //        $category->setDescription("Ma tête va exploser");
        //            //        $category->setTitle("ALED");
        //            //        $category->setIsPublished(true);
        //
        //            // La catégorie se créer et va dans la BDD
        //            $entityManager->persist($category);
        //            $entityManager->flush();
        //
        //        }
        //
        //        // le formulaire s'affiche correctement, je peux le remplir
        //       return $this ->render('admin/insert_category.html.twig' );

    }

    /**
     * @Route("/admin/categories", name="admin_list_categories")
     */

    public function listCategories(CategoryRepository $categoryRepository){
        $categories = $categoryRepository->findAll();

        return $this->render('admin/list_categories.html.twig', [
            'categories' => $categories
        ]);
    }


    /**
     * @Route("/admin/categories/{id}", name="admin_show_category")
     */
    public function showCategory($id, CategoryRepository $categoryRepository){
        $category = $categoryRepository->find($id);

        return $this->render('admin/show_category.html.twig', [
            'category' => $category
        ]);

    }

    /**
     * @Route("/admin/show_category/delete/{id}", name="admin_delete_show_category")
     */

    public function deleteShow_Category($id, CategoryRepository $categoryRepository, EntityManagerInterface  $entityManager){
        $category=$categoryRepository->find($id);

        // Je dois verifier si article n'est pas "!is_null". si c'est pas '!is_null" je peux lancer le "remove - flush" et sinon "else" je "return new" un message "Déjà supprimé"
        if (!is_null($category)) {
            $entityManager->remove($category);
            $entityManager->flush();

            $this->addFlash('success', 'Vous avez bien supprimé la categorie !');


        } return $this->redirectToRoute('admin_list_categories');

}

}