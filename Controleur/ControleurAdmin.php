<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Login.php';
require_once 'Modele/Billet.php';
require_once 'Modele/Commentaire.php';

class ControleurAdmin
{
    private $login;
    private $billet;
    private $commentaire;

    public function __construct()
    {
        $this->login = new Login();
        $this->billet = new Billet();
        $this->commentaire = new Commentaire();
    }

    //Connection admin et affichage de la page
    public function admin()
    {
        $billetsPDO = $this->billet->getBillets();
        $billets = $billetsPDO->fetchAll();
        $vue = new Vue("Admin");
        $vue->generer(array('billets' => $billets));
    }

    //Déconnection et redirection sur la page d'accueil
    public function disconnect()
    {
        session_start();
        var_dump(session_status());
        session_unset();
        session_destroy();
        header('Location: /forteroche/index.php');
    }

    //ajout d'un billet dans la BDD
    public function writeBillet($titreBillet, $contenuBillet)
    {
        //ajout du billet
        $this->billet->addBillet($titreBillet, $contenuBillet);
        //actualisation
        $billet = $this->billet->getLastCreated();
        $commentaires = $this->commentaire->getCommentairesValides($billet['id']);
        $vue = new Vue("Billet");
        $vue ->generer(array('billet' => $billet, 'commentaires' => $commentaires));
    }

    //affichage de l'interface d'édition d'un billet
    public function editBillet($idbillet)
    {
        $billet = $this->billet->getBillet($idbillet);
        $vue = new Vue("Edition");
        $vue->generer(array('billet' => $billet));
    }

    //edition d'un billet
    public function processUpdateBillet($id, $titre, $contenu)
    {
        //modification du billet
        $this->billet->updateBillet($id, $titre, $contenu);
        //actualisation
        header('Location: /forteroche/index.php?action=billet&id='.$id);
    }

    //suppression d'un billet
    public function deleteBillet($idbillet)
    {
        //suppression du billet
        $this->billet->deleteBillet($idbillet);
        //redirection
        header('Location: /forteroche/index.php?action=admin');
    }

    //affichage de l'interface de modération de commentaires
    public function moderationCommentaires()
    {
        //récupération du billet et des commentaires associés
        $PDObillets = $this->billet->getBillets();
        $billets = $PDObillets->fetchAll();
        $commentaires = [];
        foreach ($billets as $billet)
        {
            $commentaires += [ $billet['id'] => $this->commentaire->getCommentairesFromBillet($billet['id'])->fetchAll()];
        }
        //affichage de l'interface
        $vue = new Vue("Moderation");
        $vue->generer(array('billets' => $billets,'commentaires' => $commentaires));
    }

}