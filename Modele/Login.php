<?php
require_once 'Modele/Modele.php';

class Login extends Modele
{
    //verification du mot de passe
    public function isPasswordCorrect($user,$password)
    {
        //$user=$this->test_input($user);

        //Vérification des entrées utilisateur
        $user=$this->clear_string($user);
        $password=$this->clear_string($password);

        $sql = 'select LOG_PASS as pass from t_login where LOG_USER=?';
        $result = $this->executerRequete($sql, array($user));
        $passhash = $result->fetch();
        return password_verify($password,$passhash['pass']);
    }

    //verification de l'etat admin
    public function isAdmin()
    {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        return (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['connecte']) && $_SESSION['connecte'] == 'admin');
    }
}