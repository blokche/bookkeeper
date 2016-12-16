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



    public function viewFromReadingList($page, $user){

        $nb_reading_list_page=10;
        $offset=$page*$nb_reading_list_page;
        $sql="SELECT * FROM books INNER JOIN reading_list ON books.id=reading_list.book_id INNER JOIN users on users.id=reading_list.user_id WHERE users.id= :user_id LIMIT :nb_reading_list_page OFFSET :offset";

        $q=$this->dbh->prepare($sql);

        $q->bindValue(":user_id",$user['id'],\PDO::PARAM_INT);
        $q->bindValue(":nb_reading_list_page",$nb_reading_list_page,\PDO::PARAM_INT);
        $q->bindValue(":offset",$offset,\PDO::PARAM_INT);

        //var_dump($q);

        $q->execute();

        return $q->fetchAll();
    }

    public  function getFromReadingListByBookId($id,$user){


        $sql="SELECT * FROM books INNER JOIN reading_list ON books.id=reading_list.book_id INNER JOIN users on users.id=reading_list.user_id WHERE users.id= :user_id AND reading_list.book_id = :book_id LIMIT 1 ";

        $q=$this->dbh->prepare($sql);

        $q->bindValue(":user_id",$user['id'],\PDO::PARAM_INT);
        $q->bindValue(":book_id",$id,\PDO::PARAM_INT);

        //var_dump($q);

        $q->execute();

        return $q->fetch();
    }


    public function addToReadingList($bookid,$read_status){

        $sql="SELECT * FROM books INNER JOIN reading_list on books.id = reading_list.book_id INNER JOIN users on users.id = reading_list.user_id WHERE users.id = :user_id AND books.id = :book_id LIMIT 1";
        $q=$this->dbh->prepare($sql);
        $q->bindValue(":book_id",$bookid, \PDO::PARAM_INT);
        $q->bindValue(":user_id",$_SESSION['user']['id'], \PDO::PARAM_INT);
        $q->execute();
        $q=$q->fetch();

        if (!$q) {
            $sql = "INSERT INTO reading_list (book_id, user_id, read_status) VALUES (:book_id, :user_id, :read_status)";

            $q = $this->dbh->prepare($sql);

            $q->bindValue(":book_id", $bookid, \PDO::PARAM_INT);
            $q->bindValue(":user_id", $_SESSION['user']['id'], \PDO::PARAM_INT);
            $q->bindValue(":read_status", $read_status, \PDO::PARAM_INT);
        }

        return $q->execute();
    }
    

    public function deleteFromReadingList($id,$user){

        $sql="DELETE FROM reading_list WHERE book_id = :book_id and user_id = :user_id";

        $q=$this->dbh->prepare($sql);

        $q->bindValue(":book_id",$id, \PDO::PARAM_INT);
        $q->bindValue(":user_id",$user['id'],\PDO::PARAM_INT);

        return $q->execute();
    }


    public function changeStatut($id, $status,$user){


        if ($status==1) {

            $sql="UPDATE reading_list set read_status = 1 WHERE book_id = :book_id and user_id = :user_id";
            $q=$this->dbh->prepare($sql);
        } else {

            $sql="UPDATE reading_list set read_status = 0 WHERE book_id = :book_id and user_id = :user_id";
            $q=$this->dbh->prepare($sql);
        }

        $q->bindValue(":book_id",$id, \PDO::PARAM_INT);
        $q->bindValue(":user_id",$user['id'],\PDO::PARAM_INT);

        var_dump($sql);

        //die();

        return $q->execute();
    }
}
