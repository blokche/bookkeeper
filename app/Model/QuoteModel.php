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

    public function quotesAndLinkedBooksByUser($userid) {
        $query = $this->dbh->prepare("SELECT books.id as book_id, quotes.author as quote_author, quotes.content as content, quotes.content as content, quotes.id as quote_id, books.title as title FROM `quotes` LEFT JOIN books ON books.id = quotes.book_id WHERE quotes.user_id = :user_id");
        $query->bindValue(":user_id", $userid, \PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }

}