<?php
require_once 'Modele/Modele.php';

/**
 * 
 */
class Billet extends Modele
{

	/**
	 * Renvoie la liste des billets du Blog
	 */	
	public function getBillets()
	{
		$sql = 'select BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET order by BIL_ID desc';
		$billets = $this->executerRequete($sql);
		return $billets;
	}

	/**
	 * Renvoie les infos sur un billet spécifique
	 */	
	public function getBillet($idBillet) 
	{
        $sql = 'select BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET where BIL_ID=?';
        $billet = $this->executerRequete($sql, array($idBillet));
        if ($billet->rowCount() > 0)
        {
            //$sql_com = 'SELECT * FROM `t_commentaire` WHERE BIL_ID=?';
            //$nb_commentaires = $this->executerRequete($sql_com,array($idBillet));
            // retun un array !!
            // count pour récupérer le nombre 
            return $billet->fetch();  // Accès à la première ligne de résultat
        }
        else
        {
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
        }

    }
}