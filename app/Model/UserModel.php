<?php

namespace Model;

use W\Model\UsersModel;

class UserModel extends UsersModel {


    public function __construct()
    {
        parent::__construct();
        $this->setTable("users");
    }

     /**
     * @param $userId
     * @param $status 0:livre non lu ou 1:livre lu
     * @param $nbBook nombre de livre à afficher
     * @param $pagination : OFFSET = nb
     * @param $order : ASC or DESC
     * @return array
     */
    public function userReadBook($userId, $status = NULL, $nbBook = NULL, $pagination = NULL, $order=NULL){
        $read = (isset($status)) ? " AND reading_list.read_status = $status" : '';
        $nb = (isset($nbBook)) ? " LIMIT $nbBook" : '';
        $pag = (isset($pagination)) ? " OFFSET $pagination" : '';
        $ord = (isset($order)) ? " ORDER BY books.created_at $order" : '';

        $sql="SELECT * FROM books INNER JOIN reading_list on books.id = reading_list.book_id INNER JOIN users on users.id = reading_list.user_id WHERE users.id = :id $read $ord $nb $pag";
        $q=$this->dbh->prepare($sql);
        $q->bindValue(':id', $userId);
        $q->execute();
        return $q->fetchAll();

    }
}
