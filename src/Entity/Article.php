<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// La classe sera transformer en table grâce à l'ORM

/**
 * @ORM\Entity()
 */

// Création d'une classe ici nommée "Article" qui sera le nom de la table
class Article {

    //Je donne les valeurs des colonnes de ma classe

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */

    // Je transforme ma proprièté $id en  colonne grace au mapping
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $title;

    /**
     * @ORM\Column(type="string")
     */
    public $image;

    /**
     * @ORM\Column(type="string")
     */
    public $isPublished;

    /**
     * @ORM\Column(type="string")
     */
    public $author;


}

//Pour créer le fichier de migration
//"php bin/console make:migration"
//
//
//pour le comparer avec ka bdd et faire les modifications
//"php bin/console doctrine:migration:migrate"