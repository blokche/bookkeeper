<?php

namespace Model;

use W\Model\Model;
use Model\CategoryModel;

class BookModel extends Model {
  
      public function __construct()
    {
        parent::__construct();
        $this->setTable('books');
        $this->category = new CategoryModel();
    }
  
  
    public function viewFromReadingList($page){

        $nb_reading_list_page=10;
        $offset=$page*$nb_reading_list_page;
        $sql="SELECT * FROM books INNER JOIN reading_list ON books.id=reading_list.book_id INNER JOIN users on users.id=reading_list.user_id WHERE users.id= :user_id LIMIT :nb_reading_list_page OFFSET :offset";

        $q=$this->dbh->prepare($sql);

        $q->bindValue(":user_id",$_SESSION['user']['id'],\PDO::PARAM_INT);
        $q->bindValue(":nb_reading_list_page",$nb_reading_list_page,\PDO::PARAM_INT);
        $q->bindValue(":offset",$offset,\PDO::PARAM_INT);

        //var_dump($q);

        $q->execute();

        return $q->fetchAll();
    }


    public function addToReadingList($bookid,$read_status){

        $sql="INSERT INTO reading_list (book_id, user_id, read_status) VALUES (:book_id, :user_id, :read_status)";

        $q=$this->dbh->prepare($sql);

        $q->bindValue(":book_id",$bookid, \PDO::PARAM_INT);
        $q->bindValue(":user_id",$_SESSION['user']['id'], \PDO::PARAM_INT);
        $q->bindValue(":read_status",$read_status, \PDO::PARAM_INT);

        return $q->execute();
    }

    public function deleteFromReadingList($id){

        $sql="DELETE FROM reading_list WHERE book_id = :book_id and user_id = :user_id";

        $q=$this->dbh->prepare($sql);

        $q->bindValue(":book_id",$id, \PDO::PARAM_INT);
        $q->bindValue(":user_id",$_SESSION['user']['id'], \PDO::PARAM_INT);

        return $q->execute();
    }


    public function changeStatut($id, $status){


        if ($status==1) {

            $sql="UPDATE reading_list set read_status = 1 WHERE book_id = :book_id and user_id = :user_id";
            $q=$this->dbh->prepare($sql);
        } else {

            $sql="UPDATE reading_list set read_status = 0 WHERE book_id = :book_id and user_id = :user_id";
            $q=$this->dbh->prepare($sql);
        }

        $q->bindValue(":book_id",$id, \PDO::PARAM_INT);
        $q->bindValue(":user_id",$_SESSION['user']['id'], \PDO::PARAM_INT);

        var_dump($sql);

        //die();

        return $q->execute();
    }
    private $category;



    /**
     * @param $bookid ID du livre
     * @param $categorieId Catégorie associée au livre
     */
    public function addCategories ($bookid, $categorieId)
    {
        $query = $this->dbh->prepare('INSERT INTO books_categories (book_id, category_id) VALUES (:book_id, :category_id)');
        $query->bindValue(':book_id', $bookid, \PDO::PARAM_INT);
        $query->bindValue(':category_id', $categorieId, \PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * @param $bookid Supprimer les associations de catégories au livre spécifié
     */
    public function deleteCategories ($bookid)
    {
        $query = $this->dbh->prepare('DELETE FROM books_categories WHERE book_id = :book_id');
        $query->bindValue(":book_id",$bookid, \PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * @param $bookid Récupération des ID de catégories associées à un livre
     * @return array
     */
    public function getCategoriesIds($bookid)
    {
        $query = $this->dbh->prepare("SELECT category_id FROM books_categories WHERE book_id = :bookid ");
        $query->bindValue(':bookid', $bookid, \PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * @param $categoriesIds Récupérations des catégories en fonction des IDs
     * @return array
     */
    public function getCategories ($categoriesIds)
    {
        $categories = [];
        foreach ($categoriesIds as $categoryId) {
            $categories[] = $this->category->find($categoryId['category_id']);
        }
        return $categories;
    }
}