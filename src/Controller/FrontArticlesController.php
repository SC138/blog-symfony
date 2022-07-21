<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontArticlesController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="article")
     */
    public function showArticle($id, ArticleRepository $articleRepository){

        // A partir de la BDD on peut récupérer un article par rapport à L'ID
        // Ce qui donne SELECT * FROM article where id = xxx


        //Donc, la classe Repository nous permet de faire des requêtes SELECT
        // dans la "table" associée
        // Et la méthode ($xxx) permet de récupérer un élément en lien avec l'id choisi
        $article = $articleRepository->find($id);

        return $this -> render('article.html.twig', [
            "article" => $article
        ]);

}
    /**
     * @Route("/all-article", name="all-article")
     */
    public function allArticle(ArticleRepository $articleRepository){
        $articles = $articleRepository->findAll();

        return $this->render('articles.html.twig', [
            "articles" => $articles
        ]);
    }



}