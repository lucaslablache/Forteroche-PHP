<?php

require_once 'Modele/Billet.php';
require_once 'Modele/Commentaire.php';
require_once 'Vue/Vue.php';

class ControleurBillet
{
    private $billet;
    private $commentaire;

    public function __construct()
    {
        $this->billet = new Billet();
        $this->commentaire = new Commentaire();

    }

    //affichage du billet
    public function billet($idBillet)
    {
        $billet = $this->billet->getBillet($idBillet);
        $commentaires = $this->commentaire->getCommentairesValides($idBillet);
        $vue = new Vue("Billet");
        $vue ->generer(array('billet' => $billet, 'commentaires' => $commentaires));
    }

    // ajout du commentaire dans la BDD
    public function commenter($auteur, $contenu, $idBillet)
    {
        $this->commentaire->ajouterCommentaire($auteur, $contenu, $idBillet);
        //actualisation
        $this->billet($idBillet);
    }
}
