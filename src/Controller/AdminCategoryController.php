<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("insert-category", name="insert_category")
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
}