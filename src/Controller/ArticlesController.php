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

        dd($article);

    }

    /**
     * @Route("/all-article", name="all-article")
     */
    public function allArticle(ArticleRepository $articleRepository){
        $article = $articleRepository->findAll();

        dd($article);
    }



    ///**
    //     * @Route("/articles", name="articles")
    //     */
    //
    //
    //    public function articles () {
    //        $articles = [
    //            1 => [
    //                'title' => 'Non, là c\'est sale',
    //                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
    //                'publishedAt' => new \DateTime('NOW'),
    //                'isPublished' => true,
    //                'author' => 'Eric',
    //                'image' => 'https://media.gqmagazine.fr/photos/5b991bbe21de720011925e1b/master/w_780,h_511,c_limit/la_tour_montparnasse_infernale_1893.jpeg',
    //                'id' => 1
    //            ],
    //            2 => [
    //                'title' => 'Il faut trouver tous les gens qui étaient de dos hier',
    //                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
    //                'publishedAt' => new \DateTime('NOW'),
    //                'isPublished' => true,
    //                'author' => 'Maurice',
    //                'image' => 'https://fr.web.img6.acsta.net/r_1280_720/medias/nmedia/18/35/18/13/18369680.jpg',
    //                'id' => 2
    //            ],
    //            3 => [
    //                'title' => 'Pluuutôôôôt Braaaaaach, Vasarelyyyyyy',
    //                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
    //                'publishedAt' => new \DateTime('NOW'),
    //                'isPublished' => true,
    //                'author' => 'Didier',
    //                'image' => 'https://media.gqmagazine.fr/photos/5eb02109566df9b15ae026f3/master/pass/n-3freres.jpg',
    //                'id' => 3
    //            ],
    //            4 => [
    //                'title' => 'Quand on attaque l\'empire, l\'empire contre attaque',
    //                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
    //                'publishedAt' => new \DateTime('NOW'),
    //                'isPublished' => true,
    //                'author' => 'Mbala',
    //                'image' => 'https://fr.web.img2.acsta.net/newsv7/21/01/20/15/49/5077377.jpg',
    //                'id' => 4
    //                ]
    //            ];
    //                return $this->render('articles.html.twig', [
    //                    'articles' => $articles
    //                ]);
    //
    //    }
    //
    //    /**
    //     * @Route("/list/{id}", name="article_seul")
    //     */
    //
    //    public function show_articles ($id){
    //        $show_ref = [
    //            1 => [
    //                'title' => 'Non, là c\'est sale',
    //                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
    //                'publishedAt' => new \DateTime('NOW'),
    //                'isPublished' => true,
    //                'author' => 'Eric',
    //                'image' => 'https://media.gqmagazine.fr/photos/5b991bbe21de720011925e1b/master/w_780,h_511,c_limit/la_tour_montparnasse_infernale_1893.jpeg',
    //                'id' => 1
    //            ],
    //            2 => [
    //                'title' => 'Il faut trouver tous les gens qui étaient de dos hier',
    //                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
    //                'publishedAt' => new \DateTime('NOW'),
    //                'isPublished' => true,
    //                'author' => 'Maurice',
    //                'image' => 'https://fr.web.img6.acsta.net/r_1280_720/medias/nmedia/18/35/18/13/18369680.jpg',
    //                'id' => 2
    //            ],
    //            3 => [
    //                'title' => 'Pluuutôôôôt Braaaaaach, Vasarelyyyyyy',
    //                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
    //                'publishedAt' => new \DateTime('NOW'),
    //                'isPublished' => true,
    //                'author' => 'Didier',
    //                'image' => 'https://media.gqmagazine.fr/photos/5eb02109566df9b15ae026f3/master/pass/n-3freres.jpg',
    //                'id' => 3
    //            ],
    //            4 => [
    //                'title' => 'Quand on attaque l\'empire, l\'empire contre attaque',
    //                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
    //                'publishedAt' => new \DateTime('NOW'),
    //                'isPublished' => true,
    //                'author' => 'Mbala',
    //                'image' => 'https://fr.web.img2.acsta.net/newsv7/21/01/20/15/49/5077377.jpg',
    //                'id' => 4
    //            ]
    //        ];
    //        return $this->render('list.html.twig', [
    //            'show_ref' => $show_ref[$id]
    //        ]);
    //
    //    }

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