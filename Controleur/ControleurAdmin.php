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
        $billetsExculdingDeletedPDO = $this->billet->getBilletsExculdingDeleted();
        $billetsExculdingDeleted = $billetsExculdingDeletedPDO->fetchAll();

        $billetsDeletedPDO = $this->billet->getBilletsDeleted();
        $billetsDeleted = $billetsDeletedPDO->fetchAll();

        $commentairesSignalesPDO = $this->commentaire->getCommentairesSignale();
        $commentairesSignales = $commentairesSignalesPDO->fetchAll();

        $vue = new Vue("Admin");
        $vue->generer(array(
            'billetsExculdingDeleted' => $billetsExculdingDeleted,
            'billetsDeleted' => $billetsDeleted,
            'commentairesSignales' => $commentairesSignales
        ));
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

    //ajout d'un billet dans la BDD en tant que posté
    public function writeBilletFinal($titreBillet, $contenuBillet)
    {
        //ajout du billet
        $this->billet->addBilletFinal($titreBillet, $contenuBillet);
        //actualisation
        $billet = $this->billet->getLastCreated();
        $commentaires = $this->commentaire->getCommentairesValides($billet['id']);
        $vue = new Vue("Billet");
        $vue ->generer(array('billet' => $billet, 'commentaires' => $commentaires));
    }

    //ajout d'un billet dans la BDD en tant que brouillon
    public function writeBilletBrouillon($titreBillet, $contenuBillet)
    {
        //ajout du billet
        $this->billet->addBilletBrouillon($titreBillet, $contenuBillet);
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
    public function processUpdateBillet($id, $titre, $contenu, $statut)
    {
        //modification du billet
        $this->billet->updateBillet($id, $titre, $contenu, $statut);
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
    //restauration d'un billet
    public function restaurerBillet($idbillet)
    {
        //suppression du billet
        $this->billet->restaurerBillet($idbillet);
        //redirection
        header('Location: /forteroche/index.php?action=admin');
    }

    //affichage de l'interface de modération de commentaires
    public function moderationCommentaires()
    {
        //récupération du billet et des commentaires associés
        $PDObillets = $this->billet->getBilletsFinal();
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