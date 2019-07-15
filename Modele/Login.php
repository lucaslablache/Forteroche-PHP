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
}