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

    public function admin()
    {
        $billetsPDO = $this->billet->getBillets();
        $billets = $billetsPDO->fetchAll();
        $vue = new Vue("Admin");
        $vue->generer(array('billets' => $billets));
    }

    public function disconnect()
    {
        session_start();
        var_dump(session_status());
        session_unset();
        session_destroy();
        header('Location: /forteroche/index.php');
    }

    public function writeBillet($titreBillet, $contenuBillet)
    {
        //ajout du billet
        $this->billet->addBillet($titreBillet, $contenuBillet);
        //actualisation
        $billet = $this->billet->getLastCreated();
        $vue = new Vue("Billet");
        $vue ->generer(array('billet' => $billet));
    }

    public function editBillet($idbillet)
    {
        $billet = $this->billet->getBillet($idbillet);
        $vue = new Vue("Edition");
        $vue->generer(array('billet' => $billet));
    }

    public function processUpdateBillet($id, $titre, $contenu)
    {
        //modification du billet
        $this->billet->updateBillet($id, $titre, $contenu);
        //actualisation
        header('Location: /forteroche/index.php?action=billet&id='.$id);
    }

    public function moderationCommentaires()
    {
        $PDObillets = $this->billet->getBillets();
        $billets = $PDObillets->fetchAll();
        $commentaires = [];
        foreach ($billets as $billet)
        {
            $commentaires += [ $billet['id'] => $this->commentaire->getCommentairesFromBillet($billet['id'])->fetchAll()];
        }
        $vue = new Vue("Moderation");
        $vue->generer(array('billets' => $billets,'commentaires' => $commentaires));
    }

}