<?php
require_once 'Modele/Modele.php';

class Billet extends Modele
{
    //Renvoie la liste des billets postés du Blog
	public function getBilletsFinal()
	{
		$sql = 'select BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu, BIL_STATUT as statut from T_BILLET where BIL_STATUT = 0 order by BIL_ID desc';
		$billets = $this->executerRequete($sql);
        return $billets;
	}
    //Renvoie la liste des billets 'brouillons' du Blog
    public function getBilletsBrouillon()
    {
        $sql = 'select BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu, BIL_STATUT as statut from T_BILLET where BIL_STATUT = 1 order by BIL_ID desc';
        $billets = $this->executerRequete($sql);
        return $billets;
    }

    //Renvoie la liste de tous les billets du Blog pas supprimés
    public function getBilletsExculdingDeleted()
    {
        $sql = 'select BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu, BIL_STATUT as statut from T_BILLET where BIL_STATUT !=2 order by BIL_ID desc';
        $billets = $this->executerRequete($sql);
        return $billets;
    }
    //Renvoie la liste de tous les billets supprimés du Blog
    public function getBilletsDeleted()
    {
        $sql = 'select BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu, BIL_STATUT as statut from T_BILLET where BIL_STATUT =2 order by BIL_ID desc';
        $billets = $this->executerRequete($sql);
        return $billets;
    }

	//Renvoie les infos sur un billet spécifique
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

    //ajout d'un billet posté
    public function addBilletFinal($titreBillet, $contenuBillet)
    {
        $sql = 'insert into T_BILLET (BIL_DATE, BIL_TITRE, BIL_CONTENU,BIL_STATUT)'
                . 'values(?, ?, ?, 0)';
        $date = date("Y-m-d H:i:s");
        $this->executerRequete($sql, array($date, $titreBillet, $contenuBillet));
    }
    //ajout d'un billet brouillon
    public function addBilletBrouillon($titreBillet, $contenuBillet)
    {
        $sql = 'insert into T_BILLET (BIL_DATE, BIL_TITRE, BIL_CONTENU,BIL_STATUT)'
            . 'values(?, ?, ?, 1)';
        $date = date("Y-m-d H:i:s");
        $this->executerRequete($sql, array($date, $titreBillet, $contenuBillet));
    }

    //mise a jour d'un Billet
    public function updateBillet($idBillet, $titreBillet, $contenuBillet, $statutBillet)
    {
        $sql = 'UPDATE T_BILLET SET BIL_DATE = ?, BIL_TITRE = ?, BIL_CONTENU = ?, BIL_STATUT = ?'
            . 'WHERE BIL_ID = ?';
        $date = date("Y-m-d H:i:s");
        $this->executerRequete($sql, array($date, $titreBillet, $contenuBillet, $statutBillet, $idBillet));
    }

    // récupération du dernier billet entré
    public function getLastCreated()
    {
        $sql = 'select BIL_ID as id, BIL_DATE as date, BIL_TITRE as titre, BIL_CONTENU as contenu from T_BILLET order by BIL_ID DESC';
        $lastCreated=$this->executerRequete($sql, array());
        return $lastCreated->fetch();
    }

    //suppression d'un billet
    public function deleteBillet($idBillet)
    {
        $sql = 'UPDATE T_BILLET SET BIL_STATUT = 2 WHERE BIL_ID = ?';
        //$sql = 'DELETE FROM T_BILLET WHERE BIL_ID = ?';
        $this->executerRequete($sql, array($idBillet));
    }

    //suppression d'un billet
    public function restaurerBillet($idBillet)
    {
        $sql = 'UPDATE T_BILLET SET BIL_STATUT = 1 WHERE BIL_ID = ?';
        $this->executerRequete($sql, array($idBillet));
    }

    // statut billets
    // 0 = posté/visible
    // 1 = brouillon
    // 2 = corbeille


}