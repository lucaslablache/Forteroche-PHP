<?php
require_once 'Modele/Billet.php';
require_once 'Vue/Vue.php';

class ControleurAccueil
{
    private $billet;
    private $billetManager;

    public function __construct()
    {
        $this->billetManager = new Billet();
    }

    public function accueil()
    {
        $PDObillets = $this->billetManager->getBillets();
        $billets = [];
        foreach ($PDObillets as $billet)
        {
            $billet += [ 'nb_comm' => $this->billetManager->getCommentairesCount($billet['id'])];
            array_push($billets,$billet);
        }
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));

    }
}