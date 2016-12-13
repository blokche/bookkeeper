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

    public function index () {
        
    }

    /**
     * Editer le profil de l'utilisateur connecté
     */
    public function editProfile ()
    {
        $user = $this->getUser();
        $authmodel = new AuthentificationModel();
        $userModel = new UserModel();
        if (isset($_POST['editUsers'])) {
            $post = [];
            if (!empty($_POST['email']) && ($_POST['email'] != $user['email']) && !($userModel->emailExists($_POST['email']))) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $post['email'] = strip_tags(trim($_POST['email']));
                } else {
                    echo "Le nouvel email n'est pas valide";
                }
            } else {
                echo "L'email est invalide ou non disponible. Merci de changer de mot de passe.";
            }
            if (!empty($_POST['avatar'])) {
                $post['avatar'] = strip_tags(trim($_POST['avatar']));
            }
            if (!empty($_POST['newPassword'])) {
                if (($_POST['newPassword'] == $_POST['newPassword-cf'])) {
                    $post['password'] = password_hash(strip_tags(trim($_POST['newPassword'])), PASSWORD_DEFAULT);
                } else {
                    echo "Le nouveau mot de passe et la confirmation du mot de passe ne correspondent pas.";
                }
            }
            if ($authmodel->isValidLoginInfo($user['email'], $_POST['password'])) {
                if (!empty($post)) {
                    // upload + extension en base
                    $userModel->update($post, $user['id'], true);
                    $authmodel->refreshUser();
                }
            } else {
                echo "Le mot de passe ne correspond pas à l'email.";
            }

            // Upload de l'avatar
            if (isset($_FILES['avatar'])) {
                $extentions = ["image/png", "image/gif", "image/jpg", "image/jpeg"];
                if (in_array($_FILES['avatar']['type'], $extentions)) {
                    if(!is_dir(__ROOT__ . "/public/upload/avatar")){
                        mkdir(__ROOT__ . "/public/upload/avatar", 0755, true);
                    }
                    move_uploaded_file($_FILES['avatar']['tmp_name'], __ROOT__ . "/public/upload/avatar/" . $user['id']);
                } else {
                    echo "Extention invalide !";
                }
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
     * Recherche parmi les quotes, livres
     */
    public function search () {

    }
    

}