<?php

namespace Controller;

use W\Controller\Controller;
use Model\QuoteModel;
use Model\BookModel;



class QuotesController extends Controller
{
    private $quote;
    private $book;

    private $message = [];

    public function __construct()
    {
        $this->allowTo(['user', 'admin']);
        $this->book = new BookModel();
        $this->quote = new QuoteModel();
    }

    // QUOTES

    /**
     * Récupérer les citations
     */

    public function allQuotes ()
    {
        $currentUser = $this->getUser();
        $quotes = $this->quote->quotesByUser($currentUser['id']);
        $this->show("quote/quote", ['quotes' => $quotes]);
    }

    /**
     * Ajouter une citation
     */
    public function addQuote ()
    {
        $currentUser = $this->getUser();
        $books = $this->book->getBooksInReadingList($currentUser['id']);

        // Methode POST
        if (isset($_POST['addQuote']))
        {
            if (!empty($_POST['content']))
            {
                $content = trim($_POST['content']);


                /* ID du livre =  */
                if ($_POST['linkedbook'] != 0)
                {
                    $book_id = $_POST['linkedbook'];
                } else {
                    $book_id = null;
                }

                /* Auteur = anonyme par défaut. Si le champ auteur non vide, on redéfinit.
                   Si associé à un livre, on prend cette valeur en compte */

                $author = "Anonyme";

                if (!empty(trim($_POST['author'])))
                {
                    $author = trim($_POST['author']);
                } else if ($_POST['linkedbook'] > 0)
                {
                    $author = $this->book->find($_POST['linkedbook'])['author'];
                }

                if ($book_id !== null) {
                    $result = $this->quote->insert(
                        [
                            'user_id'   => $currentUser['id'],
                            'book_id'   =>  $book_id,
                            'content'   => $content,
                            'author'    => $author
                        ]
                    );
                } else {
                    $result = $this->quote->insert(
                        [
                            'user_id'   => $currentUser['id'],
                            'content'   => $content,
                            'author'    => $author
                        ]
                    );
                }

                if ($result) {

                    $this->message[] = ['type' => 'success', 'message' => 'Ajout de l\'extrait, de la citation effectué avec succès'];
                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute("profile.quote", ['page' => 0]);
                } else {

                    $this->message[] = ['type' => 'warning', 'message' => 'Une erreur est survenue lors de l\'ajout.'];
                    $_SESSION['message']=$this->message;
                }

            } else {
                // Cas du champ contenu vide
                $this->message[] = ['type' =>'warning', 'Le message ainsi que l\'auteur ne peuvent être vides'];
                $_SESSION['message']=$this->message;
                $this->show("quote/add-quote", ['books' => $books]);
            }
        } else {
            // Méthode GET
            $this->show("quote/add-quote",['books' => $books]);
        }
    }

    /**
     * Editer une citation
     * @param $quoteid
     */
    public function editQuote ($quoteid) {

        $quote = $this->quote->find($quoteid);

        // Si la quote existe en BDD
        if ($quote)
        {
            $currentUser = $this->getUser();
            $books = $this->book->getBooksInReadingList($currentUser['id']);

            // Méthode POST
            if (isset($_POST['editQuote']))
            {

                if ( !empty($_POST['content']) )
                {
                    $author = 'Anonyme';

                    if ( !empty(trim($_POST['author'])) ) {
                        $author = trim($_POST['author']);
                    } elseif ( (int) $_POST['linkedbook'] > 0) {
                        $author = $this->book->find($_POST['linkedbook'])['author'];
                    }

                    $content = trim($_POST['content']);

                    // Date de la modification
                    $date = new \DateTime();
                    $date = $date->format("Y-m-d H:i:s");


                    $book_id = -1;
                    if ($_POST['linkedbook'] > 0)
                    {
                        $book_id = $_POST['linkedbook'];
                    }

                    $retour = $this->quote->update(
                        [
                            'book_id'       => $book_id,
                            'content'       => $content,
                            'author'        => $author,
                            'updated_at'    => $date
                        ],
                        $quoteid);

                    if ($retour)
                    {
                        $this->message[] = ['type' => 'success', 'message' => 'Citation / extrait modifié avec succès.'];
                        $_SESSION['message']=$this->message;
                        $this->redirectToRoute("profile.quote");
                    } else {

                        $this->message[] = ['type' => 'success', 'message' => 'Citation / extrait modifié avec succès.'];
                        $_SESSION['message']=$this->message;
                        $this->show("quote/edit-quote", ['id' => $quoteid]);
                    }
                }
                else {
                    $this->message[] = ['type' => 'warning', 'message' => 'La citation, l\extrait ne pas pas être vide.'];
                    $_SESSION['message']=$this->message;
                    $this->show("quote/edit-quote", ['quoteid'=>$quoteid]);
                }
            } else {
                // Méthode GET
                $this->show("quote/edit-quote",['quote'=> $quote,'books'=>$books]);
            }

        } else {
            // Redirection si la quote n'existe pas
            $this->showNotFound();
        }

    }

    /**
     * Supprimer une citation
     * @param $quoteid
     */
    public function deleteQuote ($quoteid) {

        $quote = $this->quote->find($quoteid);

        if ($quote) {

            $this->quote->delete($quoteid);
            $this->message[] = ['type' => "success", 'message' => 'Suppression de la citation, de l\'extrait effectué avec succès.'];
            $_SESSION['message']=$this->message;
        } else {
            
            $this->redirectToRoute('profile.quote');
        }

        $this->redirectToRoute("profile.quote");
    }
}
