<?php

namespace Controller;

use W\Controller\Controller;

class ProfileController
{
    /**
     *
     */
    public function index () {

    }

    /**
     * Editer le profil de l'utilisateur connecté
     */
    public function editProfile () {

    }

    /**
     * Supprimer le profil de l'utilisateur connecté
     */
    public function deleteProfile () {

    }

    /**
     * Consulter les livres dans la reading list
     * @param int $page
     */
    public function viewBooks ($page = 1) {

    }

    /**
     * Ajouter un livre
     */
    public function addBook () {

    }

    /**
     * Marquer un livre comme lu/non en fonction de son id
     * @param $bookid
     */
    public function toggleRead ($bookid) {

    }

    /**
     * Supprimer un livre de sa liste de lecture
     * @param $bookid
     */
    public function deleteBook($bookid) {

    }

    // Quotes

    /**
     * Récupérer les citations
     * @param int $page
     */
    public function allQuotes ($page = 1) {

    }

    /**
     * Ajouter une citation
     */
    public function addQuote () {

    }

    /**
     * Editer une citation
     * @param $quoteid
     */
    public function editQuote ($quoteid) {
        
    }

    /**
     * Supprimer une citation
     * @param $quoteid
     */
    public function deleteQuote ($quoteid) {

    }

    /**
     * Recherche parmi les quotes, livres
     */
    public function search () {

    }
    

}