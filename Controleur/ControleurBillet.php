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
    public function commenter($auteur, $contenu, $mail, $idBillet)
    {
        $mailPDO=$this->commentaire->getUser($auteur);
        $userTable=$mailPDO->fetch();
        if ($mail == $userTable['mail'] || $userTable['mail'] == false)
        {
            $this->commentaire->ajouterCommentaire($auteur, $contenu, $mail, $idBillet);
            //actualisation
            $this->billet($idBillet);
        }
        else
        {
            throw new Exception("le pseudo '$auteur' est deja utilisé veuillez en choisir un autre");
        }
    }
}
