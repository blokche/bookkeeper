<?php

namespace Controller;

use W\Controller\Controller;
use Model\QuoteModel;
use Model\BookModel;
use Model\UserModel;





class QuotesController extends Controller
{
    private $quote;
    private $book;
    //private $user;


    private $errors = [];
    private $message = [];


    public function __construct()
    {
        $this->book = new BookModel();
        $this->book->setTable('books');
        $this->quote = new QuoteModel();
        $this->quote->setTable("quotes");
        //$this->user = new UserModel();

    }





    // Quotes

    /**
     * Récupérer les citations
     * @param int $page
     */
    public function allQuotes ($page = 1) {

        $this->allowTo(['user','admin']);

        $nb_quote_page=10;
        $offset=$page*$nb_quote_page;
        $quotes=$this->quote->findAll("id",'ASC',$nb_quote_page,$offset);
        $this->show("quote/quote",['quotes' => $quotes]);
    }


    /**
     * Ajouter une citation
     */
    public function addQuote () {

        $this->allowTo(['user','admin']);

        $books=$this->book->findAll();

        var_dump($books);

        if (isset($_POST['addQuote'])){
            if (!empty($_POST['content']) && !empty($_POST['author'])) {
                $content = trim($_POST['content']);
                $author = trim($_POST['author']);
                $bookID=trim($_POST['book']);
                if($bookID!=-1){
                    $author=$this->book->find($bookID)['author'];
                }

                $this->quote->insert(
                    [
                        'user_id'   => $_SESSION['user']['id'],
                        'book_id'   => $bookID,
                        'content'   => $content,
                        'author'    => $author
                    ]
                );

                $this->redirectToRoute("profile.quote", ['page' => 0]);
            } else {
                $this->errors['add-quote'] = "l'auteur ou le contenue sont vide.";
                $_SESSION['add-quote'] = $this->errors['add-quote'];
                $this->show("quote/add-quote",['books' => $books]);
            }
        }

        $this->show("quote/add-quote",['books' => $books]);
    }



    /**
     * Editer une citation
     * @param $quoteid
     */
    public function editQuote ($quoteid) {

        $this->allowTo(['user','admin']);

        $quoteid=trim(strip_tags($quoteid));

        if (isset($_POST['editQuote'])){

            if (!empty($_POST['content'])&& !empty($_POST['author'])){
                $content=trim($_POST['content']);
                $author=trim($_POST['author']);
                $bookID=trim($_POST['book']);
                if($bookID!=-1){
                    $author=$this->book->find($bookID)['author'];
                }

                $date=new \DateTime();
                $date=$date->format("Y-m-d H:i:s");

                $this->quote->update(
                    [
                        'book_id'       => $bookID,
                        'content'       => $content,
                        'author'        => $author,
                        'updated_at'    => $date
                    ],
                    $quoteid);
                $this->redirectToRoute("profile.quote",['page'=> 0]);
            }
            else{
                $this->errors['edit-quote']="l'author ou le contenue sont vide.";
                $_SESSION['edit-quote']=$this->errors['edit-quote'];
                $this->show("quote/edit-quote",['quoteid'=>$quoteid]);
            }
        }

        $quote=$this->quote->find($quoteid);

        //var_dump($quote);
        $books=$this->book->findAll();
        $this->show("quote/edit-quote",['quote'=> $quote,'books'=>$books]);
    }



    /**
     * Supprimer une citation
     * @param $quoteid
     */
    public function deleteQuote ($quoteid) {

        $this->allowTo(['user','admin']);

        $quote=$this->quote->find($quoteid);

        if ($quote) {

            $this->quote->delete($quoteid);
            $this->message['toggleRead']="La citation a bien été supprimé";
            $_SESSION['message']=$this->message['toggleRead'];
        } else {

            $this->errors['toggleRead']="La citation n'existe pas";
            $_SESSION['errors']=$this->errors['toggleRead'];
        }

        $this->redirectToRoute("profile.quote",['page'=> 0]);
    }
}
