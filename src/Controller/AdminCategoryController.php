<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/insert-category", name="admin/insert_category")
     */

    public function insertCategory (EntityManagerInterface $entityManager){

        $category = new Category();

        $category->setColor("red");
        $category->setDescription("Ma tête va exploser");
        $category->setTitle("ALED");
        $category->setIsPublished(true);

        $entityManager->persist($category);
        $entityManager->flush();
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
        if (!is_null($category)){
            $entityManager->remove($category);
            $entityManager->flush();

            return new Response('CATEGORIE Supprimé');
        } else {
            return new Response('CATEGORIE Déjà supprimé');

        }
    }
}