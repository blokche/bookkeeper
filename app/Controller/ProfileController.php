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

        $bookRead = $userModel->userReadBook($user['id'], 1, 6);
        $bookNoRead = $userModel->userReadBook($user['id'], 0 , 6);

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
                        $this->message[]=['type' =>'warning', 'message' => "Le nouvel email n'est pas valide"];
                        $_SESSION['message'] = $this->message;
                    }
                } else {
                    $this->message[]=['type' =>'warning', 'message' => "L'email est invalide ou non disponible. Merci de changer de mot de passe."];
                    $_SESSION['message'] = $this->message;
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
                    $this->message[]=['type' =>'warning', 'message' => "Extention invalide !"];
                    $_SESSION['message'] = $this->message;
                }
            }

            // Upload password
            if (!empty($_POST['newPassword'])) {
                if (($_POST['newPassword'] == $_POST['newPassword-cf'])) {
                    $post['password'] = password_hash(strip_tags(trim($_POST['newPassword'])), PASSWORD_DEFAULT);
                } else {
                    $this->message[]=['type' =>'warning', 'message' => "Le nouveau mot de passe et la confirmation du mot de passe ne correspondent pas."];
                    $_SESSION['message'] = $this->message;
                }
            }

            if ($authmodel->isValidLoginInfo($user['email'], $_POST['password'])) {
                if (!empty($post)) {
                    // upload + extension en base
                    $userModel->update($post, $user['id'], true);
                    $authmodel->refreshUser();
                    $this->message[]=['type' =>'success', 'message' => "Le profil a été mis à jour."];
                    $_SESSION['message'] = $this->message;
                }
            } else {
                $this->message[]=['type' =>'warning', 'message' => "Le mot de passe ne correspond pas à l'email."];
                $_SESSION['message'] = $this->message;
            }

        }
        $this->show('profile/edit');
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
        $this->allowTo(['user','admin']);
        $user = $this->auth->getLoggedUser();

        $message = [];

        if (isset($_POST['addBook'])) {
            if (!empty($_POST['title']) && !empty($_POST['author'])) {
                $title = trim($_POST['title']);
                $author = trim($_POST['author']);

                // Enregistrement de la couverture
                $name = (!empty($_FILES['cover']['name'])) ? strtolower(strstr($_FILES['cover']['name'], '.', true)) : 'default.png';
                $type = (!empty($_FILES['cover']['name'])) ? str_replace("/",".",strstr($_FILES['cover']['type'], '/')):'';
                $timestamp = (!empty($_FILES['cover']['name'])) ? "-".time() : '';
                $cover = 'default.png';
                if (isset($_FILES['cover']['type']) && !empty($_FILES['cover']['name'])) {
                    $extentions = ["image/png", "image/gif", "image/jpg", "image/jpeg"];
                    if (in_array($_FILES['cover']['type'], $extentions)) {
                        if(!is_dir(__ROOT__ . "/public/upload/cover")){
                            mkdir(__ROOT__. "/public/upload/cover", 0755, true);
                        }
                        move_uploaded_file($_FILES['cover']['tmp_name'], __ROOT__ . "/public/upload/cover/" . $name.$timestamp.$type);
                        $cover = $name.$timestamp.$type;
                    } else {
                        $this->message[]=['type' =>'warning', 'message' => "Extention invalide ! La couverture du livre n'est pas enregistrer"];
                        $_SESSION['message'] = $this->message;
                        $cover = 'default.png';
                        //$message[] = "Extention invalide !";
                    }
                }
                // Innsettion dans la base donnée
                $newBook=$this->book->insert(
                    [
                        'title'   => $title,
                        'author'    => $author,
                        'created_by'   => $user['id'],
                        'status' => 1,
                        'cover' => $cover,
                    ]
                );

                if ($newBook) {
                    $this->message[] = ['type' => 'success', 'message' => "Le livre a bien été ajouté"];

                }else{
                    $this->message[]=['type' =>'warning', 'message' => "Une erreur inconnu s'est produite pendant l'ajout du livre, veuillez ré-essayer."];
                }
                
                if (isset($_POST['optionsRadios'])) {
                    $read_status=$_POST['optionsRadios'];
                    $retour = $this->book->addToReadingList($newBook['id'], $read_status);
                    if ($retour) {
                        $this->message[]=['type' =>'success', 'message' => "Le livre a bien été ajouté à votre de liste de lecture"];
                        $_SESSION['message'] = $this->message;

                    } else {
                        $this->message[]=['type' =>'warning', 'message' => "Une erreur s'est produite, veuillez ré-essayer"];
                        $_SESSION['message'] = $this->message;
                    }
                }

                $_SESSION['message'] = $this->message;
                $this->redirectToRoute('profile.book.add');
            } else {
                $this->message[]=['type' =>'warning', 'message' => "l'auteur ou le contenue sont vide."];
                $_SESSION['message'] = $this->message;
                $this->show("book/add-book");
            }
        }

        $this->show("book/add-book");

    }




    public function  addBookToReadingList ($id,$status){
        $retour = $this->user->addToReadingList($id,$status,$this->getUser());

        if ($retour) {
            $this->message[]=['type' =>'success', 'message' => "Le livre a bien été ajouté à votre de liste de lecture"];
            $_SESSION['message'] = $this->message;
        }

        $this->redirectToRoute("public.view",['id' => $id]);
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

            $this->message [] = ['type' => 'warning', 'message' => "Le livre n'existe pas"];
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
            }else{

                $this->message [] = ['type' => 'success', 'message' => "Une erreur pendant le changement de status s'est produite, veuillez réessayer"];
                $_SESSION['message']=$this->message;
            }

            $this->redirectToRoute("public.view",['id'=> $id]);

        } else {
            
            $this->message [] = ['type' => 'warning', 'message' => "Le livre n'existe pas"];
            $_SESSION['message']=$this->message;
            $this->redirectToRoute("profile.book",['page'=> 0]);
        }

    }


}