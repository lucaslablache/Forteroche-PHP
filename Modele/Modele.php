<?php
/**
 * Classe abstraite Modèle.
 * Centralise les services d'accès à une base de données.
 */
abstract class Modele
{
	private $bdd;
	
	protected function executerRequete ($sql,$params = null)
	{
		if ($params == null) 
		{
			$resultat = $this->getBdd()->query($sql); //execution directe
		}
		else
		{
			$resultat = $this->getBdd()->prepare($sql); //requete préparée
			$resultat->execute($params);
		}
		return $resultat;
	}

	private function getBdd()
	{
		if ($this->bdd == null) 
		{
			// Création de la connexion dev
			//$this->bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            // Création de la connexion prod
            $this->bdd = new PDO('mysql:host=pencilanhf456db.mysql.db;dbname=pencilanhf456db;charset=utf8','pencilanhf456db','ovh456Db',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		return $this->bdd;
	}

	//Fonction de vérification des entrées utilisateur
    function clear_string($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}