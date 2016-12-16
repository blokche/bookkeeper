<?php

namespace Model;

use W\Model\Model;
use Model\CategoryModel;

class BookModel extends Model {

    private $category;

    public function __construct()
    {
        parent::__construct();
        $this->setTable('books');
        $this->category = new CategoryModel();
    }


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

    /**
     * Effectuer une recherche sur un livre en fonction de son titre ou de son auteur
     * @param $term Titre ou auteur recherché
     * @return array Résultats de la recherche
     */
    public function searchBook ($term)
    {
        $sql = "SELECT * FROM books WHERE LOWER(books.title) RLIKE LOWER(:term) OR LOWER(books.author) RLIKE LOWER(:term)";
        $query = $this->dbh->prepare($sql);
        $query->bindValue(':term', $term, \PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll();
    }

    public function getBooksByIds($ids = [])
    {
        $books = [];
        $query = $this->dbh->prepare('SELECT * FROM books WHERE id = :id');
        foreach ($ids as $id) {
            $query->bindValue(":id", $id, \PDO::PARAM_INT);
            $query->execute();
            $books[] = $query->fetch();
        }
        return $books;
    }

    /**
     * Retourner les livres présents dans la liste de lecture d'un utilisateur
     * @param int $userid
     * @return array
     */
    public function getBooksInReadingList ($userid = 0)
    {
        $query = $this->dbh->prepare('SELECT * FROM reading_list WHERE user_id = :userid');
        $query->bindValue(":userid", $userid, \PDO::PARAM_INT);
        $query->execute();
        $books = $query->fetchAll();
        $books = array_map(function($book) {
            return $book['book_id'];
        }, $books);
        $books = $this->getBooksByIds($books);
        return $books;
    }
}