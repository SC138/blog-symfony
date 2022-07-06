<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// Création d'un Objet Relationnel de Mapping (ORM) avec le frameworl Doctrine

/**
 * @ORM\Entity()
 */

// Création d'une classe ici nommée "Article" qui sera le nom de la BDD
class Article {

    //Je donne les valeurs des colonnes de ma classe

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */

    // Je transforme le titre de la colonne en méthode
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $title;
}

