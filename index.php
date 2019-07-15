<?php
require 'Controleur/Routeur.php';

//echo $_SERVER['REQUEST_URI'];
$routeur = new Routeur();
$routeur->routerRequete();