<?php
require_once 'Modele/Modele.php';

class Login extends Modele
{
    public function isPasswordCorrect($user,$password)
    {
        $sql = 'select LOG_PASS as pass from t_login where LOG_USER=?';
        $result = $this->executerRequete($sql, array($user));
        $passhash = $result->fetch();
        return password_verify($password,$passhash['pass']);
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