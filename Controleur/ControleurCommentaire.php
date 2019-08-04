<?php
require_once 'Modele/Billet.php';
require_once 'Modele/Commentaire.php';
require_once 'Vue/Vue.php';

class ControleurCommentaire
{
    private $commentaire;
    private $billet;

    public function __construct()
    {
        $this->commentaire = new Commentaire();
        $this->billet = new Billet();
    }

    public function signalerCommentaire($idCommentaire)
    {
        $this->commentaire->setCommentaireSignale($idCommentaire);
        $idBillet = $this->commentaire->getBilletId($idCommentaire);
        //redirection
        header('Location: /forteroche/index.php?action=billet&id='.$idBillet);
    }


}