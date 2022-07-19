<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminArticlesController extends AbstractController
{
    /**
     * @Route("/admin/article/{id}", name="admin_article")
     */
    public function showArticle($id, ArticleRepository $articleRepository){

        // A partir de la BDD on peut récupérer un article par rapport à L'ID
        // Ce qui donne SELECT * FROM article where id = xxx


        //Donc, la classe Repository nous permet de faire des requêtes SELECT
        // dans la "table" associée
        // Et la méthode ($xxx) permet de récupérer un élément en lien avec l'id choisi
        $article = $articleRepository->find($id);

        return $this -> render('admin/article.html.twig', [
            "article" => $article
        ]);

    }

    /**
     * @Route("/admin/all-article", name="admin_all-article")
     */
    public function allArticle(ArticleRepository $articleRepository){
        $articles = $articleRepository->findAll();

        return $this->render('admin/articles.html.twig', [
            "articles" => $articles
        ]);
    }





    /**
     * @Route("/admin/insert-article", name="admin_insert_article")
     */
    public function insertArticle (EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger) {

        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        // Si le formulaire a été posté et que les données sont validées (valeurs)
        // des inputs correspondent à ce qui est attebdu en BDD pour la table article
        if($form->isSubmitted() && $form->isValid()){
            $image = $form->get('image')->getData();

            //j'utilise une instance de la classe Slugger et sa méthode slug pour
            // supprimer les caractères spéciaux, espaces etc du nom du fichier
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            // je rajoute au nom de l'image, un identifiant unique (au cas où l'image soit uploadée plusieurs fois
            $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

            $image->move(
                $this->getParameter('images_directory'),
                $newFilename
            );

            $article->setImage($newFilename);

            //alors on eneregistre l'article en BDD
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Article enregistré !');
        }



        return $this->render("admin/insert_article.html.twig", [
            "form"=>$form->createView()
        ]);









//        //Creation d'une instance de la classe Article (Def: La "Classe Article" est une "Classe Entité")
//        // Qui va servir à créer un nouvel article dans la BDD (Qui correspond à la "Table Article")
//
//        $article = new Article();
//
//        // Utilisation des Setters (Setters = set... EXEMPLE: setTitle. Qui ne sert QUE pour les PRIVATE). Donc, Utilisation des Setters du titre/contenu/Publié/Date etc
//        $article->setTitle("J'aime les titres");
//        $article->setContent("Les descriptions c'est beaucoup trop bien, mais pas autant que les titres");
//        $article->setIsPublished(true);
//        $article->setAuthor("Qu'est ce que ça ?");
//
//
//        // Avec la classe EntityManagerInterface de Doctrine pour enregister l'entité dans al BDD directement dans la table article.
//        // D'abord avec le "persist" et après avec le "flush"
//        $entityManager->persist($article);
//        $entityManager->flush();
//
//        $this->addFlash('success', 'Vous avez bien créé l\'article !');
//
//        return $this ->redirectToRoute('admin_all-article');
    }

    /**
     * @Route("/admin/articles/delete/{id}", name="admin_delete_article")
     */

    public function deleteArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager)
    {
        $article = $articleRepository->find($id);

        if (!is_null($article)) {
            $entityManager->remove($article);
            $entityManager->flush();

            $this->addFlash('success', 'Vous avez bien supprimé l\'article !');
        }
        return $this->redirectToRoute('admin_all-article');
            }



    //Creation d'une nouvelle route pour notifier le UPDATE dans l'URL
    /**
     * @Route("/admin/article/update/{id}", name="admin_update_article")
     */

//Idem pour la méthode sur laquelle on indique le "updateArticle" et surtout les : $id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager
    public function updateArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger){
        $article = $articleRepository->find($id);
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        // Si le formulaire a été posté et que les données sont validées (valeurs)
        // des inputs correspondent à ce qui est attebdu en BDD pour la table article
        if($form->isSubmitted() && $form->isValid()){

            // je récupère l'image dans le formulaire (l'image est en mapped false donc c'est à moi
            // de gérer l'upload
            $image = $form->get('image')->getData();

            // je récupère le nom du fichier original
            $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

            // j'utilise une instance de la classe Slugger et sa méthode slug pour
            // supprimer les caractères spéciaux, espaces etc du nom du fichier
            $safeFilename = $slugger->slug($originalFilename);
            // je rajoute au nom de l'image, un identifiant unique (au cas ou
            // l'image soit uploadée plusieurs fois)
            $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

            // je déplace l'image dans le dossier public et je la renomme avec le nouveau nom créé
            $image->move(
                $this->getParameter('images_directory'),
                $newFilename
            );
            $article->setImage($newFilename);

            //alors on eneregistre l'article en BDD
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Article enregistré !');
        }



        return $this->render("admin/update_article.html.twig", [
            "form"=>$form->createView(),
            'article' => $article
        ]);
    }

}