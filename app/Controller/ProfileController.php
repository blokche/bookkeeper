<?php

namespace Controller;

use Model\UserModel;
use W\Controller\Controller;
use Model\User;
use W\Security\AuthentificationModel;



class ProfileController extends Controller
{
    private $auth;
    private $user;
    private $errors = [];
    private  $message = [];


    public function __construct()
    {
        $this->auth = new AuthentificationModel();
        $this->user = new UserModel();
    }

       

    /**
     * 
     */
    public function index () {
        $this->allowTo(['user','admin']);
        $user = $this->getUser();
        $userModel = new UserModel();
        $avatar = (!empty($user['avatar'])) ? $user['id'].$user['avatar'] : 'default.png';
        $bookRead = $userModel->userReadBook($user['id'], 1, 5);
        $bookNoRead = $userModel->userReadBook($user['id'], 0 , 5);

       //$coverRead = (!empty($bookRead['cover'])) ? $bookRead['cover'] : 'default.jpg';
        //$coverNoRead = (!empty($bookNoRead['cover'])) ? $bookNoRead['cover'] : 'default.jpg';
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
                    $message[] = "Le profil a été mis à jour.";
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
                $this->message['delete-profil']="Votre profil a bien eté supprimé.";
                $_SESSION['message']=$this->message['delete-profil'];
                $this->redirectToRoute('home');
            }
            else{
                $this->errors['delete-profil']="Une erreur s'est produite, veuillez re-essayéer.";
                $_SESSION['errors']=$this->errors['delete-profil'];
                $this->redirectToRoute('profile.home');
            }
        }
    }
    


    /**
     * Consulter les livres dans la reading list
     * @param int $page
     */
    public function viewBooks ($page = 1) {
        $this->allowTo(['user','admin']);
        $user = $this->getUser();
        $userModel = new UserModel();
        $offset='';
        $bookRead = $userModel->userReadBook($user['id'],1);
        $bookNoRead = $userModel->userReadBook($user['id'],0);
        

        $this->show('profile/book', ['bookRead' => $bookRead, 'bookNoRead' => $bookNoRead]);
    }

    /**
     * Recherche parmi les quotes, livres
     */
    public function search () {

    }
    
}