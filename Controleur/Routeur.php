<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurBillet.php';
require_once 'Controleur/ControleurLogin.php';
require_once 'Controleur/ControleurAdmin.php';
require_once 'Controleur/ControleurCommentaire.php';
require_once 'Vue/Vue.php';

class Routeur
{
    private $ctrlAccueil;
    private $ctrlBillet;
    private $ctrlLogin;
    private $ctrlAdmin;
    private $ctrlCommentaire;

    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlBillet = new ControleurBillet();
        $this->ctrlLogin = new ControleurLogin();
        $this->ctrlAdmin = new ControleurAdmin();
        $this->ctrlCommentaire = new ControleurCommentaire();
    }

    public function routerRequete()
    {
        try
        {
            if (isset($_GET['action']))
            {
                if ($_GET['action'] == 'billet' or $_GET['action'] == 'commenter')
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
                                $mail = $this->getParametre($_POST, 'mail');
                                $this->ctrlBillet->commenter($auteur, $contenu, $mail, $idBillet);
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
                elseif ($_GET['action'] == 'signaler')
                {
                    $idCommentaire = $this->getParametre($_POST, 'id');
                    $this->ctrlCommentaire->signalerCommentaire($idCommentaire);
                }
                elseif ($_GET['action'] == 'login')
                {
                    if ($this->isAdmin())
                    {
                       header('Location: /forteroche/index.php?action=admin');
                    }
                    else
                    {
                        $vue = new Vue("Login");
                        $vue ->generer(array());
                    }
                }
                elseif ($_GET['action'] == 'try_login')
                {
                    $this->ctrlLogin->try_connect();
                }
                elseif ($_GET['action'] == 'admin')
                {
                    if ($this->isAdmin())
                    {
                        $this->ctrlAdmin->admin();
                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }
                }
                elseif ($_GET['action'] == 'moderation')
                {
                    if ($this->isAdmin())
                    {
                        $this->ctrlAdmin->moderationCommentaires();
                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }
                }
                elseif ($_GET['action'] == 'validerComm')
                {
                    if ($this->isAdmin())
                    {
                        $idCommentaire = $this->getParametre($_POST, 'id');
                        $this->ctrlCommentaire->validerCommentaire($idCommentaire);
                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }
                }
                elseif ($_GET['action'] == 'supprimerComm')
                {
                    if ($this->isAdmin())
                    {
                        $idCommentaire = $this->getParametre($_POST, 'id');
                        $this->ctrlCommentaire->supprimerCommentaire($idCommentaire);
                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }
                }
                elseif ($_GET['action'] == 'addBillet')
                {
                    if ($this->isAdmin())
                    {
                        if ($_POST['statut'] == 0)
                        {
                            $this->ctrlAdmin->writeBilletFinal($_POST['titre'], $_POST['contenu']);
                        }
                        elseif ($_POST['statut'] == 1)
                        {
                            $this->ctrlAdmin->writeBilletBrouillon($_POST['titre'], $_POST['contenu']);
                        }

                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }
                }
                elseif ($_GET['action'] == 'editBillet')
                {
                    if ($this->isAdmin())
                    {
                        $this->ctrlAdmin->editBillet($_POST['id']);
                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }
                }
                elseif ($_GET['action'] == 'updateBillet')
                {
                    if ($this->isAdmin())
                    {
                        $this->ctrlAdmin->processUpdateBillet($_POST['id'], $_POST['titre'], $_POST['contenu'], $_POST['statut']);
                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }

                }
                elseif ($_GET['action'] == 'deleteBillet')
                {
                    if ($this->isAdmin())
                    {
                        $this->ctrlAdmin->deleteBillet($_POST['id']);
                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }
                }
                elseif ($_GET['action'] == 'restaurerBillet')
                {
                    if ($this->isAdmin())
                    {
                        $this->ctrlAdmin->restaurerBillet($_POST['id']);
                    }
                    else
                    {
                        header('Location: /forteroche/index.php?action=login');
                    }
                }
                elseif ($_GET['action'] == 'disconnect')
                {
                    $this->ctrlAdmin->disconnect();
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

    public function isAdmin()
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        return (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['connecte']) && $_SESSION['connecte'] == 'admin');
    }
}