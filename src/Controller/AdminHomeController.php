<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin_home")
     */

    public function home (ArticleRepository $articleRepository) {


        $last_articles = $articleRepository->findBy([], ['id' => 'DESC'],3);
        return $this->render('admin/home.html.twig', [
            'articles' => $last_articles
        ]);
    }
}