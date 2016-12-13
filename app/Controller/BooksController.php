<?php

namespace Controller;

use W\Controller\Controller;
use Model\BookModel;



class BooksController extends Controller
{
    private $book;
    private $errors = [];
    private $message = [];


    public function __construct()
    {
        $this->book = new BookModel();
        $this->book->setTable("books");
    }



    /**
     * Consulter les livres dans la reading list
     * @param int $page
     */
    public function viewBooks ($page = 0) {
        
        $books=$this->book->viewFromReadingList($page);
        
        if($books){
            $this->show("book/reading-list",['books'=>$books]);
        }else{
            $this->errors['reading-list']="Aucun livre dans la liste de lecture n'as été trouvé";
            $this->show("book/reading-list",['errors' => $this->errors]);
        }
    }

    
    
    
    /**
     * Ajouter un livre
     */
    public function addBook ()
    {

        if (isset($_POST['addBook'])) {

            if (!empty($_POST['title']) && !empty($_POST['author'])) {
                $title = trim($_POST['title']);
                $author = trim($_POST['author']);


                if (isset($_POST['cover'])) {
                    $cover = trim($_POST['cover']);
                }else{
                    $cover="";
                }

                var_dump($_POST);



                $newBook=$this->book->insert(
                    [
                        'title'   => $title,
                        'author'    => $author,
                        'created_by'   => $_SESSION['user']['id'],
                        'status' => 1,
                        'cover' => $cover
                    ]
                );

                var_dump($newBook);
                

                if (isset($_POST['optionsRadios'])) {

                    $read_status=$_POST['optionsRadios'];
                    
                    $retour = $this->book->addToReadingList($newBook['id'], $read_status);

                    if ($retour) {
                        $this->message['toggleRead'] = "Le livre a bien été ajouté à votre de liste de lecture";
                        $_SESSION['message'] = $this->message['toggleRead'];
                    } else {
                        $this->errors['toggleRead'] = "Une erreur s'est produite, veuillez ré-essayér";
                        $_SESSION['errors'] = $this->errors['toggleRead'];
                    }
                }

            } else {

                $this->errors['add-book'] = "l'auteur ou le contenue sont vide.";
                $_SESSION['errors'] = $this->errors['add-book'];
                $this->show("book/add-book");
            }
        }

        $this->show("book/add-book");

    }



    
    
    /**
     * Supprimer un livre de sa liste de lecture
     * @param $bookid
     */
    public function deleteBook($id) {

        $rl=$this->book->find($id);

        if ($rl) {
            
            $retour = $this->book->deleteFromReadingList($id);

            if ($retour){
                $this->message['toggleRead']="Le livre a bien été enlevé de votre de liste de lecture";
                $_SESSION['message']=$this->message['toggleRead'];
            }else{
                $this->errors['toggleRead']="Une erreur s'est produite, veuillez ré-essayér";
                $_SESSION['errors']=$this->errors['toggleRead'];
            }
            
        } else {

            $this->errors['toggleRead']="Le livre n'existe pas";
            $_SESSION['errors']=$this->errors['toggleRead'];
        }

        $this->redirectToRoute("profile.book",['page'=> 0]);
    }



    /**
     * Marquer un livre comme lu/non en fonction de son id
     * @param $bookid
     */
    public function toggleRead ($id, $status) {

        $rl=$this->book->find($id);

        if ($rl) {

            $retour=$this->book->changeStatut($id, $status);

            if ($retour){
                $this->message['toggleRead']="Le statut du livre a bien été changé";
                $_SESSION['message']=$this->message['toggleRead'];
                $this->redirectToRoute('profile.book', ['page' => 0]);
            }else{
                $this->errors['toggleRead']="Une erreur s'est produite, veuillez ré-essayér";
                $_SESSION['errors']=$this->errors['toggleRead'];
            }

            $this->redirectToRoute("profile.book",['page'=> 0]);

        } else {
            $this->errors['toggleRead']="Le livre n'existe pas";
            $_SESSION['errors']=$this->errors['toggleRead'];
            $this->redirectToRoute("profile.book",['page'=> 0]);
        }

    }




}
