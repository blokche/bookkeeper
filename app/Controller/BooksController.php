<?php

namespace Controller;

use W\Controller\Controller;
use Model\BookModel;
use W\Security\AuthentificationModel;



class BooksController extends Controller
{
    private $book;
    private $auth;
    private $errors = [];
    private $message = [];




    public function __construct()
    {
        $this->book = new BookModel();
        $this->book->setTable("books");
        $this->auth = new AuthentificationModel();
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
        $user = $this->auth->getLoggedUser();

        $message = [];

        if (isset($_POST['addBook'])) {



            if (!empty($_POST['title']) && !empty($_POST['author'])) {
                $title = trim($_POST['title']);
                $author = trim($_POST['author']);

                //$name = strstr($_FILES['cover']['name'], '.', true);
                $name = (!empty($_FILES['cover']['name'])) ? strstr($_FILES['cover']['name'], '.', true) : 'default.png';
                $type = (!empty($_FILES['cover']['name'])) ? str_replace("/",".",strstr($_FILES['cover']['type'], '/')):'';
                $timestamp = (!empty($_FILES['cover']['name'])) ? "-".time() : '';
                $cover = $name.$timestamp.$type;

               if (isset($_FILES['cover']['type']) && !empty($_FILES['cover']['name'])) {
                    $extentions = ["image/png", "image/gif", "image/jpg", "image/jpeg"];
                     if (in_array($_FILES['cover']['type'], $extentions)) {
                         if(!is_dir(__ROOT__ . "/public/upload/cover")){
                             mkdir(__ROOT__. "/public/upload/cover", 0755, true);
                         }
                         move_uploaded_file($_FILES['cover']['tmp_name'], __ROOT__ . "/public/upload/cover/" . $name.$timestamp.$type);
                     } else {
                         $message[] = "Extention invalide !";
                     }
               }
                $newBook=$this->book->insert(
                    [
                        'title'   => $title,
                        'author'    => $author,
                        'created_by'   => $user['id'],
                        'status' => 1,
                        'cover' => $cover,
                    ]
                );
                $message[] = "Le livre a bien été ajouté à votre de liste de lecture";

                if (isset($_POST['optionsRadios'])) {

                    $read_status=$_POST['optionsRadios'];
                    
                    $retour = $this->book->addToReadingList($newBook['id'], $read_status);

                    if ($retour) {
                        $message[] = "Le livre a bien été ajouté à votre de liste de lecture";
                    } else {
                        $message[] = "Une erreur s'est produite, veuillez ré-essayér";
                    }
                }

            } else {

                $message[] = "l'auteur ou le contenue sont vide.";

                $this->show("book/add-book");
            }
        }

        $this->show("book/add-book", ['message' => $message]);

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
