<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Login.php';
require_once 'Modele/Billet.php';

class ControleurAdmin
{
    private $login;
    private $billet;

    public function __construct()
    {
        $this->login = new Login();
        $this->billet = new Billet();
    }

    public function admin()
    {
        // alertes boostrap pour la modération
        // protection utilisateur
        // sanitise field (ancien)
        // utiliser https://www.php.net/manual/en/mysqli.real-escape-string.php
        // htmlspecial chars pour html

        // tiny MCE documenter

        if ($this->login->isAdmin())
        {
            $billetsPDO = $this->billet->getBillets();
            $billets = $billetsPDO->fetchAll();
            $vue = new Vue("Admin");
            $vue->generer(array('billets' => $billets));
        }
        else
        {
            header('Location: /forteroche/index.php?action=login');
        }
    }

    public function writeBillet($titreBillet, $contenuBillet)
    {
        if ($this->login->isAdmin())
        {
            //ajout du billet
            $this->billet->addBillet($titreBillet, $contenuBillet);
            //actualisation
            $billet = $this->billet->getLastCreated();
            header('Location: /forteroche/index.php?action=billet&id='.$billet['id']);

        }
        else
        {
            header('Location: /forteroche/index.php?action=login');
        }
    }

    public function editBillet($idbillet)
    {
        $billet = $this->billet->getBillet($idbillet);
        $vue = new Vue("Edition");
        $vue->generer(array('billet' => $billet));
    }

    public function processUpdateBillet($id, $titre, $contenu)
    {
        if ($this->login->isAdmin())
        {
            //modification du billet
            $this->billet->updateBillet($id, $titre, $contenu);
            //actualisation
            header('Location: /forteroche/index.php?action=billet&id='.$id);
        }
        else
        {
            header('Location: /forteroche/index.php?action=login');
        }
    }
}