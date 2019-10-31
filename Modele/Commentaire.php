<?php
require_once 'Modele/Modele.php';

class Commentaire extends Modele
{
    //renvoie la liste des commentaires associés a un billet spécifique
    public function getCommentaires($idBillet)
    {
        $sql = 'select COM_ID as id, COM_DATE as date, COM_AUTEUR as auteur,'
        . 'COM_CONTENU as contenu from T_COMMENTAIRE where BIL_ID=?';
        $commentaires = $this->executerRequete($sql, array($idBillet));
        return $commentaires;
    }

    // renvoie la liste des commentaires validés par l'administrateur
    public function getCommentairesValides ($idBillet)
    {
        $sql = 'select COM_ID as id, COM_DATE as date, COM_AUTEUR as auteur,'
            . 'COM_CONTENU as contenu, COM_STATUT as statut from T_COMMENTAIRE where BIL_ID=?'
            . 'AND COM_STATUT != 3';
        $commentaires = $this->executerRequete($sql, array($idBillet));
        return $commentaires;
    }

    // com statut
    // 0 = crée
    // 1 = signalé
    // 2 = validé
    // 3 = supprimé

    //assigne le statut "signalé" a un commentaire
    public function setCommentaireSignale($idCommentaire)
    {
        $sql = 'UPDATE T_COMMENTAIRE SET COM_STATUT = 1 WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }

    //assigne le statut "supprimé" a un commentaire
    public function setCommentaireSupprime($idCommentaire)
    {
        $sql = 'UPDATE T_COMMENTAIRE SET COM_STATUT = 3 WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }

    //assigne le statut "validé" a un commentaire
    public function setCommentaireValide($idCommentaire)
    {
        $sql = 'UPDATE T_COMMENTAIRE SET COM_STATUT = 2 WHERE COM_ID = ?';
        $this->executerRequete($sql, array($idCommentaire));
    }

    // Ajoute un commentaire dans la BDD
    public function ajouterCommentaire($auteur, $contenu, $idBillet)
    {
        //Vérification des entrées utilisateur
        $auteur=$this->clear_string($auteur);
        $contenu=$this->clear_string($contenu);

        $sql = 'insert into T_COMMENTAIRE (COM_DATE, COM_AUTEUR, COM_CONTENU, COM_STATUT, BIL_ID)'
            . 'values(?, ?, ?, ?, ?)';
        $date = date("Y-m-d H:i:s");
        //$date = date(DATE_W3C);
        $comstatut=0; //on donne le statut 'crée' au commentaire
        $this->executerRequete($sql, array($date, $auteur, $contenu, $comstatut, $idBillet));
    }

    //récupère l'id d'un billet
    public function getBilletId($idCommentaire)
    {
        $sql = 'SELECT BIL_ID as bil_id FROM T_COMMENTAIRE where COM_ID=?';
        $idBilletPDO = $this->executerRequete($sql, array($idCommentaire));
        $requestResult = $idBilletPDO->fetch();
        return $requestResult['bil_id'];
    }

    //récupère les commentaires d'un billet
    public function getCommentairesFromBillet($idBillet)
    {
        $sql = 'SELECT COM_ID as id, COM_DATE as date, COM_AUTEUR as auteur,'
            . 'COM_CONTENU as contenu, COM_STATUT as statut FROM T_COMMENTAIRE where BIL_ID=?';
        $commentairesPDO = $this->executerRequete($sql,array($idBillet));
        return $commentairesPDO;
    }
}