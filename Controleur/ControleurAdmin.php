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
            $vue = new Vue("Admin");
            $vue->generer(array());
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
            $this->lastCreated();

        }
        else
        {
            header('Location: /forteroche/index.php?action=login');
        }
    }
}