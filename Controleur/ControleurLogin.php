<?php
require_once 'Vue/Vue.php';

// IMPORTANT hasher le password
// et le stocker dans la BDD

class ControleurLogin
{
    function est_connecte (): bool
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        return !empty($_SESSION['connecte']);
    }


    function try_connect ()
    {
        if (!empty($_POST['pseudo']) && !empty($_POST['password']))
        {
            if ($_POST['pseudo'] == 'Fromage' && $_POST['password'] == 'dechevre')
            {
                //on connecte l'admin
                if (session_status() == PHP_SESSION_NONE)
                {
                    session_start();
                }
                $_SESSION['connecte'] = 'admin';
                header('Location: /forteroche/index.php');

            }
            else
            {
                throw new Exception("Identifiants incorects");
            }
        }
    }
}