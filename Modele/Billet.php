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
            return $billet->fetch();  // Accès à la première ligne de résultat
        }

        else
        {
            throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
        }

    }

    //recupération du nombre de commentaires
    public function getCommentairesCount($idBillet)
    {
        $sql = 'select * from T_COMMENTAIRE where BIL_ID=?';
        $commentaireCount = $this->executerRequete($sql, array($idBillet));
        $commentaires = $commentaireCount->fetchAll();
        return count($commentaires);
    }

    //ajout d'un billet
    public function addBillet($titreBillet, $contenuBillet)
    {
        //vérification des entrées utilisateur
        $titreBillet=$this->clear_string($titreBillet);
        $contenuBillet=$this->clear_string($contenuBillet);

        $sql = 'insert into T_BILLET (BIL_DATE, BIL_TITRE, BIL_CONTENU)'
                . 'values(?, ?, ?)';
        $date = date("Y-m-d H:i:s");
        $this->executerRequete($sql, array($date, $titreBillet, $contenuBillet));
    }

    //mise a jour d'un Billet
    public function updateBillet($idBillet, $titreBillet, $contenuBillet)
    {
        //vérification des entrées utilisateur
        $titreBillet=$this->clear_string($titreBillet);
        $contenuBillet=$this->clear_string($contenuBillet);

        $sql = 'UPDATE T_BILLET SET BIL_DATE = ?, BIL_TITRE = ?, BIL_CONTENU = ?'
            . 'WHERE BIL_ID = ?';
        $date = date("Y-m-d H:i:s");
        $this->executerRequete($sql, array($date, $titreBillet, $contenuBillet,$idBillet));
    }

    // récupération du dernier billet entré
    public function getLastCreated()
    {
        $sql = 'select * from T_BILLET order by BIL_ID LIMIT 1';
        $lastCreated=$this->executerRequete($sql, array());
        return $lastCreated->fetch();
    }

}