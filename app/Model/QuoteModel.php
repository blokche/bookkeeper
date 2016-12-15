<?php

namespace Model;

use W\Model\Model;

class QuoteModel extends Model {
  
    public function __construct()
    {
        parent::__construct();
        $this->setTable("quotes");
    }

    /**
     * @param $userid Id de l'utilisateur courant
     * @return array Tableau de citations pour l'utilisateur
     */
    public function quotesByUser($userid)
    {
        $query = $this->dbh->prepare('SELECT * FROM quotes WHERE user_id = :user_id');
        $query->bindValue(":user_id", $userid, \PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }
}