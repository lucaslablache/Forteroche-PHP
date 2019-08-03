<?php
require_once 'Modele/Modele.php';

class Commentaire extends Modele
{

    //renvoie la liste des commentaires associés a un billet spécifique
    public function getCommentaires($idBillet)
    {
        $sql = 'select COM_ID as id, COM_DATE as date, COM_AUTEUR as auteur,'
        . 'COM_CONTENU as contenu from T_COMMENTAIRE where BIL_ID=?';
        //AND where bil_stat!=X;
        $commentaires = $this->executerRequete($sql, array($idBillet));
        return $commentaires;
    }

    // Ajoute un commentaire dans la BDD
    public function ajouterCommentaire($auteur, $contenu, $idBillet)
    {
        //Vérification des entrées utilisateur
        $auteur=$this->clear_string($auteur);
        $contenu=$this->clear_string($contenu);

        $sql = 'insert into T_COMMENTAIRE (COM_DATE, COM_AUTEUR, COM_CONTENU, BIL_ID)'
            . 'values(?, ?, ?, ?)';
        $date = date("Y-m-d H:i:s");
        //$date = date(DATE_W3C);
        $this->executerRequete($sql, array($date, $auteur, $contenu, $idBillet));
    }

}