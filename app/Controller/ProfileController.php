<?php

namespace Controller;

use Model\UserModel;
use W\Controller\Controller;
use Model\User;
use Model\BookModel;
use W\Security\AuthentificationModel;



class ProfileController extends Controller
{
    private $auth;
    private $user;
    private $book;
    private $message = [];

    public function __construct()
    {
        $this->allowTo(['user','admin']);
        $this->auth = new AuthentificationModel();
        $this->user = new UserModel();
        $this->book = new BookModel();
        $this->book->setTable("books");
    }


    /**
     * 
     */
    public function index () {
        $user = $this->getUser();
        $userModel = new UserModel();
        $avatar = (!empty($user['avatar'])) ? $user['id'].$user['avatar'] : 'default.png';
        $bookRead = $userModel->userReadBook($user['id'], 1, 5);
        $bookNoRead = $userModel->userReadBook($user['id'], 0 , 5);

       //$coverRead = (!empty($bookRead['cover'])) ? $bookRead['cover'] : 'default.png';
        //$coverNoRead = (!empty($bookNoRead['cover'])) ? $bookNoRead['cover'] : 'default.png';
        $this->show('profile/home', ['avatar' => $avatar, 'bookRead' => $bookRead, 'bookNoRead' => $bookNoRead]);
    }

    /**
     * Editer le profil de l'utilisateur connecté
     */
    public function editProfile ()
    {
        $user = $this->getUser();
        $message =[];
        $authmodel = new AuthentificationModel();
        $userModel = new UserModel();
        if (isset($_POST['editUsers'])) {
            $post = [];

            // Upload Email
            if(($_POST['email'] !== $user['email'])){
                if (!empty($_POST['email']) && !($userModel->emailExists($_POST['email']))) {
                    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $post['email'] = strip_tags(trim($_POST['email']));
                    } else {
                        $message[] = "Le nouvel email n'est pas valide";
                    }
                } else {
                    $message[] = "L'email est invalide ou non disponible. Merci de changer de mot de passe.";
                }
            }
            // Upload Speudo
            if(($_POST['username'] !== $user['username'])){
                        $post['username'] = strip_tags(trim($_POST['username']));
                    }

            // Upload de l'avatar

            if (isset($_FILES['avatar']['type']) && !empty($_FILES['avatar']['name'])) {
                $extentions = ["image/png", "image/gif", "image/jpg", "image/jpeg"];
                if (in_array($_FILES['avatar']['type'], $extentions)) {
                    if(!is_dir(__ROOT__ . "/public/upload/avatar")){
                        mkdir(__ROOT__. "/public/upload/avatar", 0755, true);
                    }
                    $post['avatar'] = str_replace("/",".",strstr($_FILES['avatar']['type'], '/'));
                    move_uploaded_file($_FILES['avatar']['tmp_name'], __ROOT__ . "/public/upload/avatar/" . $user['id'].$post['avatar']);
                } else {
                    $message[] = "Extention invalide !";
                }
            }

            // Upload password
            if (!empty($_POST['newPassword'])) {
                if (($_POST['newPassword'] == $_POST['newPassword-cf'])) {
                    $post['password'] = password_hash(strip_tags(trim($_POST['newPassword'])), PASSWORD_DEFAULT);
                } else {
                    $message[]= "Le nouveau mot de passe et la confirmation du mot de passe ne correspondent pas.";
                }
            }

            if ($authmodel->isValidLoginInfo($user['email'], $_POST['password'])) {
                if (!empty($post)) {
                    // upload + extension en base
                    $userModel->update($post, $user['id'], true);
                    $authmodel->refreshUser();
                    $message[] = "Le profil a été mis à jour.";
                }
            } else {
                $message[]= "Le mot de passe ne correspond pas à l'email.";
            }

        }
        $this->show('profile/edit', ['message' => $message]);
    }



    /**
     * Supprimer le profil de l'utilisateur connecté
     */
    public function deleteProfile () {

        if (isset($_SESSION['id'])) {

            if ($this->user->delete($_SESSION['id'])) {

                $this->auth->logUserOut();
                $this->message[] = ['type' => 'success', 'message' => "Votre profil a bien eté supprimé."];
                $_SESSION['message']=$this->message;
                $this->redirectToRoute('home');
            }
            else{

                $this->message[] = ['type' => 'warning', 'message' => "Une erreur pendant la suppresion s'est produite, veuillez re-essayéer"];
                $_SESSION['message']=$this->message;
                $this->redirectToRoute('profile.home');
            }
        }
    }
    


    /**
     * Consulter les livres dans la reading list
     * @param int $page
     */
    public function viewBooks ($page = 0) {
        
        $limit='10';

        $offset=$page*$limit;

        $user = $this->getUser();
        $bookRead = $this->user->userReadBook($user['id'],1,$limit,$offset,"DESC");
        $bookNoRead = $this->user->userReadBook($user['id'],0,$limit,$offset,"DESC");


        $this->show('profile/book', ['bookRead' => $bookRead, 'bookNoRead' => $bookNoRead]);
    }

    /**
     * Recherche parmi les quotes, livres
     */
    public function search () {

    }





    /**
     * Ajouter un livre
     */
    public function addBook ()
    {

        if (isset($_POST['addBook'])) {

            if (!empty($_POST['title'])) {
                $title = trim($_POST['title']);
                if(isset($_POST['author']))
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

                    $retour = $this->user->addToReadingList($newBook['id'], $read_status ,$this->getUser());

                    if ($retour) {
                        $this->message['toggleRead'] = "Le livre a bien été ajouté à votre de liste de lecture";
                        $_SESSION['message'] = $this->message['toggleRead'];
                    } else {
                        $this->errors['toggleRead'] = "Une erreur s'est produite, veuillez ré-essayér";
                        $_SESSION['errors'] = $this->errors['toggleRead'];
                    }

                    $this->redirectToRoute("public.view",['id'=> $newBook['id']]);
                }

            } else {

                $this->errors['add-book'] = "l'auteur ou le contenue sont vide.";
                $_SESSION['errors'] = $this->errors['add-book'];
                $this->show("book/add-book");
            }
        }

        $this->show("book/add-book");

    }

    public function  addBookToReadingList ($id,$status){
        $this->user->addToReadingList($id,$status,$this->getUser());
        $this->redirectToRoute("profile.book",['page' => 0]);
    }
    



    /**
     * Supprimer un livre de sa liste de lecture
     * @param $bookid
     */
    public function deleteBook($id) {

        $rl=$this->book->find($id);

        if ($rl) {

            $retour = $this->user->deleteFromReadingList($id ,$this->getUser());

            if ($retour){

                $this->message[] = ['type' => 'success', 'message' => "Le livre a bien été enlevé de votre de liste de lecture"];
                $_SESSION['message']=$this->message;
            }else{

                $this->message[] = ['type' => 'warning', 'message' => "Une erreur pendant la suppresion du livre s'est produite, veuillez ré-essayér"];
                $_SESSION['message']=$this->message;
            }

            $this->redirectToRoute("public.view",['id'=> $id]);
        } else {

            $this->message[] = ['type' => 'warning', 'message' => "Le livre n'existe pas"];
            $_SESSION['message']=$this->message;
            $this->redirectToRoute("profile.book",['page'=> 0]);
        }

    }



    /**
     * Marquer un livre comme lu/non en fonction de son id
     * @param $bookid
     */
    public function toggleRead ($id, $status) {

        $rl=$this->book->find($id);

        if ($rl) {

            $retour=$this->user->changeStatut($id, $status ,$this->getUser());

            if ($retour){

                $this->message[] = ['type' => 'success', 'message' => "Le statut du livre a bien été changé"];
                $_SESSION['message']=$this->message;
                $this->redirectToRoute('profile.book', ['page' => 0]);
            }else{

                $this->message [] = ['type' => 'success', 'message' => "Une erreur pendant le changement de status s'est produite, veuillez ré-essayér"];
                $_SESSION['message']=$this->message;
            }

            $this->redirectToRoute("public.view",['id'=> $id]);

        } else {
            
            $this->message []= ['type' => 'warning', 'message' => "Le livre n'existe pas"];
            $_SESSION['message']=$this->message;
            $this->redirectToRoute("profile.book",['page'=> 0]);
        }

    }


}