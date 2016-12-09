<?php

namespace Controller;

use Model\Book;
use Model\Quote;
use W\Controller\Controller;

class AdminController extends Controller {


    private $User;
    private $Book;
    private $Quote;


    public function __construct()
    {
        $this->User  = new User();
        $this->Book  = new Book();
        $this->Quote = new Quote();
    }

    public function index () {
        // Retourner une vue pour afficher différentes stats
    }

    /**
     * Lister l'ensemble des utilisateurs
     */
    public function allUsers($page = 1) {

    }

    /**
     * Consulter les informations d'un utilisateur
     * @param $userid
     */
    public function viewUser($userid) {

    }

    /**
     * Editer un utilisateur
     * @param $userid
     */
    public function editUser($userid) {

    }

    /**
     * Supprimer un utilisateur
     * @param $userid
     */
    public function deleteUser($userid) {

    }

    /**
     * Désactiver un utilisateur
     * @param $id
     */
    public function toggleStatus ($id) {

    }

    // Books Management

    /**
     * Retourner la liste de tous les livres sur le site
     * @param int $page
     */
    public function allBooks ($page = 1) {

    }

    /**
     * Consulter la fichier d'un film
     * @param $bookid
     */
    public function viewBook ($bookid) {

    }

    /**
     * Editer une fiche livre
     * @param $bookid
     */
    public function editBook ($bookid) {

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