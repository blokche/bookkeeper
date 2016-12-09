<?php

namespace Controller;

use W\Security\AuthentificationModel;
use Model\AuthentificationModel as AuthModel;
use \W\Security\StringUtils;
use \W\Controller\Controller;
use Model\User;



class AuthentificationController extends Controller
{

    private $auth;
    private $User;


    public function __construct()
    {
        $this->auth = new AuthentificationModel();
        $this->User = new User();
    }


    public function login() {
        $errors = [];

        if(isset($_POST['login'])){
            $userCheck = $this->auth->isValidLoginInfo($_POST['email'], $_POST['password']);

            if($userCheck){
                $currentUser = $this->User->find($userCheck);
                if ($currentUser['status']) {
                    $this->auth->logUserIn($currentUser);
                    $this->redirectToRoute('profile.home');
                }
                else {
                    $errors="Erreur cette utilisateur est actuellement desactivé.";
                    $this->show('Authentification/login',['errors'=> $errors]);
                }
            }

            else{
                $errors="Erreur l'email et le mot de passe saisie ne correspondent pas.";
                $this->show('Authentification/login',['errors'=> $errors]);
            }
        }
    }


    public function logout() {
        $this->auth->logUserOut();
        $this->redirectToRoute('home');
    }


    public function register () {

        // Inscription
        if(isset($_POST['register'])){

            $errors = [];
            $errors['email'] = (empty($_POST['email'])) ? "Erreur email vide" : null;
            $errors['username'] = (empty($_POST['username'])) ? "Erreur username vide" : null;
            $errors['password'] = (empty($_POST['password'])) ? "Erreur password vide" : null;

            if($_POST['password'] != $_POST['cf-password'])
            {
                $errors['cf-password'] = "Erreur password et confirmation ne correspond pas";
            }

            if($this->User->emailExists($_POST['email']) || $this->User->usernameExists($_POST['username'])){
                $errors['validity'] = "Username or email exists.";
            }

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)==false){
                $errors['email']="Erreur l'email saisie est invalide";
            }


            if(count(array_unique($errors)) == 1){

                $user_connected=[
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $this->auth->hashPassword($_POST['password'])
                ];

                $this->User->insert($user_connected);
                $this->auth->logUserIn($user_connected);
                $this->redirectToRoute('profile.home');
                // Envoi d'email, ajout d'un message

            }
            else{
                $this->show('default/home',['errors'=>$errors]);
            }
        }
    }

    public function forgetPassword ()
    {
        if (isset($_POST['forget-password'])) {
            $errors = [];

            if (empty($_POST['email'])) {
                if ($this->User->emailExists($_POST['email'])) {
                    $secu_chaine = new StringUtils();
                    $user_forget_password = $this->User->getUserByUsernameOrEmail($_POST['email']);
                    $this->User->update(['token' => $secu_chaine->randomString()], $user_forget_password['id']);

                    //envoie du mail a  faire dans un model a part
                    $this->redirectToRoute('home');
                }
                else {
                    $errors['email'] = "L'email saisie est incorrect !";
                    $this->show('Authentification/forget-password',['errors'=>$errors]);
                }
            }
            else {
                $errors['email'] =  "Erreur email vide";
                $this->show('Authentification/forget-password',['errors'=>$errors]);
            }

        }

        $this->show('Authentification/forget-password');
    }

    public function resetPassword () {

        $errors =  [];
        $message = [];

        if (isset($_GET['token'])) {

            $authModel=new AuthModel();
            $user_token=$authModel->findToken($_GET['token']);
            //var_dump($user_token);

            if ($user_token) {
                $this->show('Authentification/reset-password',['id' => $user_token['id']]);
            }

            else {
                $errors['token']=" Erreur le token est incorrect";
                $this->redirectToRoute('home');
            }

        }

        else{
            $errors['token'] = "Erreur le token est manquant";
            $this->redirectToRoute('home');
        }

        if (isset($_POST['reset-password'])) {

            if (!empty($_POST['password'])) {

                if ($_POST['password'] == $_POST['cf-password']) {
                    $id=strip_tags($_POST['id']);
                    // a besoin de l'id du user pour mettre a jour le token
                    $this->User->update(['password' => $this->auth->hashPassword($_POST['password']), 'token' => null],$id);
                    $message="Le mot de passe a bien été mis a jour .";
                    $this->redirectToRoute('profile.home');
                }

                else {
                    $errors['password'] = "Erreur le password et la confirmation ne correspondent pas !";
                    $this->show('Authentification/reset-password',['errors'=>$errors]);
                }

            }

            else {
                $errors['password'] = "Erreur le password est vide" ;
                $this->show('Authentification/reset-password',['errors'=>$errors]);
            }

        }

        //var_dump($errors);

    }
}