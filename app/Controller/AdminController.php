<?php

namespace Controller;


use Model\BookModel;
use Model\QuoteModel;

use W\Controller\Controller;
use W\Model\UsersModel;

class AdminController extends Controller {


    private $user;
    private $quote;
    private $book;

    public function __construct()
    {
        // $this->allowTo('admin');
        $this->user = new UsersModel();
        $this->quote = new QuoteModel();
        $this->book = new BookModel();
        $this->book->setTable('books');
        $this->quote->setTable('quotes');

    }

    public function index () {
        $totalUsers = count($this->user->findAll());
        $totalQuotes = count($this->quote->findAll());
        $totalBooks = count($this->book->findAll());

        $this->show('admin/index', [
            'totalUsers' => $totalUsers,
            'totalQuotes' => $totalQuotes,
            'totalBooks' => $totalBooks
        ]);
    }

    /**
     * Lister l'ensemble des utilisateurs
     */
    public function allUsers() {
        $users = $this->user->findAll();
        $this->show('admin/allusers', ['users' => $users]);
    }

    /**
     * Consulter les informations d'un utilisateur
     * @param $userid
     */
    public function viewUser($userid) {
        $user = $this->user->find($userid);
        if ($user) {
            $this->show('admin/userdetails.php');
        } else {
            $this->showNotFound();
        }
    }

    /**
     * Editer un utilisateur
     * @param $userid
     */
    public function editUser($userid) {
        $user = $this->user->find($userid);
        if ($user) {
            if (isset($_POST['edit'])) {

            } else {
                $this->show('admin.user.edit', ['user' => $user]);
            }
        } else {
            $this->showNotFound();
        }
    }

    /**
     * Supprimer un utilisateur
     * @param $userid
     */
    public function deleteUser($userid)
    {
        $user = $this->user->find($userid);
        if ($user) {
            $this->user->delete($userid);
            $this->redirectToRoute('admin.home');
        } else {
            $this->redirectToRoute('admin.user');
        }
    }

    /**
     * Désactiver un utilisateur
     * @param $userid
     */
    public function toggleStatus ($userid)
    {
        $user = $this->user->find($userid);
        if ($user)
        {
            if ($user['status'])
            {
                $this->user->update([
                    'status' => 0
                ], $user['id']);
            } else {
                $this->user->update([
                    'status' => 1
                ], $user['id']);
            }
        } else {
            $this->redirectToRoute('admin.user');
        }
    }

    // Books Management

    /**
     * Retourner la liste de tous les livres sur le site
     */
    public function allBooks () {
        $books = $this->book->findAll();
        $this->show('admin/allbooks', ['books' => $books]);
    }

    /**
     * Consulter la fichier d'un film
     * @param $bookid
     */
    public function viewBook ($bookid) {
        $book = $this->book->find($bookid);
        if ($book) {
            $this->show('admin/bookdetails', ['book' => $book]);
        } else {
            $this->redirectToRoute('admin.book');
        }
    }

    /**
     * Editer une fiche livre
     * @param $bookid
     */
    public function editBook ($bookid) {
        $book = $this->book->find($bookid);
        if ($book) {
            if (isset($_POST['edit']))
            {

                // Gérer la mise à jour
                var_dump($_POST);
                var_dump($_FILES);
            } else {
                $this->show('admin/editbook', ['book' => $book]);
            }
        } else {
            $this->showNotFound();
        }
    }

    /**
     * Ajouter un livre
     */
    public function addBook () {

    }

    /**
     * Supprimer un livre
     * @param $bookid
     */
    public function deleteBook ($bookid) {

    }

    // Category management

    /**
     *  Récupérer l'ensemble des catégories
     */
    public function allCategories () {

    }

    /**
     * Editer une catégorie
     * @param $catid
     */
    public function editCategory ($catid) {

    }

    /**
     * Supprimer une catégorie
     * @param $catid
     */
    public function deleteCategory ($catid) {

    }


}