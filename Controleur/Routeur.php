<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurBillet.php';
require_once 'Vue/Vue.php';

class Routeur
{
    private $ctrlAccueil;
    private $ctrlBillet;

    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlBillet = new ControleurBillet();
    }

    public function routerRequete()
    {
        try
        {
            if (isset($_GET['action']))
            {
                if ($_GET['action'] == 'billet')
                {
                    $idBillet = inval($this->getParametre($_GET, nom:'id'));
                    if ($idBillet != 0)
                    {
                        $this->ctrlBillet->billet($idBillet);
                    }
                    else
                    {
                        throw new Exception(message:"Identifiant de billet non valide");
                    }
                }
                else if ($_GET['action'] == 'commenter')
                {
                    $auteur =$this->getParametre($_POST, nom:'auteur');
                    $contenu =$this->getParametre($_POST, nom:'contenu');
                    $idBillet =$this->getParametre($_POST, nom:'id');
                    $this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
                }
                else
                {
                    throw new Exception("action non valide");
                }

            }
            else
            {
                $this->ctrlAccueil->accueil();
            }
        }
        catch (Exception $e)
        {
            $this->erreur($e->getMessage());
        }
    }

    private function erreur ($msgErreur)
    {
        $vue = new Vue(action:"Erreur"); //syntaxe ?
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    private function getParametre($tableau, $nom)
    {
        if (isset($tableau[$nom]))
        {
            return $tableau[$nom];
        }
        else
        {
            throw new Exception(message:"parametre '$nom' absent");
        }
    }
}
?>