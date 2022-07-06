<?php

namespace App\Controller;

use App\Entity\Category;
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

        dd($category);

    }
}