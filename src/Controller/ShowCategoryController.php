<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowCategoryController extends AbstractController
{
 /**
  * @Route("/show-category", name="show-category")
  */
 public function showCategory(CategoryRepository $categoryRepository){
     $category = $categoryRepository->find(1);

     dd($category);
 }
}