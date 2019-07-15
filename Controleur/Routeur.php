<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurBillet.php';
require_once 'Controleur/ControleurLogin.php';
require_once 'Controleur/ControleurAdmin.php';
require_once 'Vue/Vue.php';

class Routeur
{
    private $ctrlAccueil;
    private $ctrlBillet;
    private $ctrlLogin;
    private $ctrlAdmin;

    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlBillet = new ControleurBillet();
        $this->ctrlLogin = new ControleurLogin();
        $this->ctrlAdmin = new ControleurAdmin();
    }

    public function routerRequete()
    {
        try
        {
            if (isset($_GET['action']))
            {
                if ($_GET['action'] == 'billet')
                {
                    if (isset($_GET['id']))
                    {
                        $idBillet = intval($this->getParametre($_GET, 'id'));
                        if ($idBillet != 0)
                        {
                            if ($_GET['action'] == 'billet')
                            {
                                $this->ctrlBillet->billet($idBillet);
                            }
                            else if ($_GET['action'] == 'commenter')
                            {
                                $auteur = $this->getParametre($_POST, 'auteur');
                                $contenu = $this->getParametre($_POST, 'contenu');
                                $this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
                            }
                            else
                            {
                                throw new Exception("action non valide");
                            }
                        }
                    }
                    else
                    {
                        throw new Exception("Identifiant de billet non valide");
                    }

                }
                elseif ($_GET['action'] == 'login')
                {
                    $vue = new Vue("Login");
                    $vue ->generer(array());
                }
                elseif ($_GET['action'] == 'try_login')
                {
                    $this->ctrlLogin->try_connect();
                }
                elseif ($_GET['action'] == 'admin')
                {
                    $this->ctrlAdmin->admin();
                }

                else
                {
                    throw new Exception ("identifiant inexistant");
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
        $vue = new Vue("Erreur");
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
            throw new Exception("parametre '$nom' absent");
        }
    }
}