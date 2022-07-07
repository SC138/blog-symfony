<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function showArticle(ArticleRepository $articleRepository){

        // A partir de la BDD on peut récupérer un article par rapport à L'ID
        // Ce qui donne SELECT * FROM article where id = xxx


        //Donc, la classe Repository nous permet de faire des requêtes SELECT
        // dans la "table" associée
        // Et la méthode ($xxx) permet de récupérer un élément en lien avec l'id choisi
        $article = $articleRepository->find(1);

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





    /**
     * @Route("insert-article", name="insert_article")
     */
    public function insertArticle (EntityManagerInterface $entityManager) {

        //Creation d'une instance de la classe Article (Def: La "Classe Article" est une "Classe Entité)
        // Qui va servir à créer un nouvel article dans la BDD (Qui correspond à la "Table Article")

        $article = new Article();

        // Utilisation des Setters (Setters = set... EXEMPLE: setTitle. Qui ne sert QUE pour les PRIVATE). Donc, Utilisation des Setters du titre/contenu/Publié/Date etc
        $article->setTitle("J'aime les titres");
        $article->setContent("Les descriptions c'est beaucoup trop bien, mais pas autant que les titres");
        $article->setIsPublished(true);
        $article->setAuthor("Qu'est ce que ça ?");


        // Avec la classe EntityManagerInterface de Doctrine pour enregister l'entité dans al BDD directement dans la table article.
        // D'abord avec le "persist" et après avec le "flush"
        $entityManager->persist($article);
        $entityManager->flush();

        dump($article); die;

    }
}