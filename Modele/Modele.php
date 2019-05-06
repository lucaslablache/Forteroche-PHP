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
			// Création de la connexion
			$this->bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}
		return $this->bdd;
	}
}

?>