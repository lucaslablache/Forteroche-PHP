<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Login.php';

class ControleurAdmin
{
    private $login;

    public function __construct()
    {
        $this->login = new Login();
    }

    public function admin()
    {
        //$billet = $this->billet->getBillet($idBillet);
        //$commentaires = $this->commentaire->getCommentaires($idBillet);
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

}