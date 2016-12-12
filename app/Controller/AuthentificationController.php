<?php

namespace Controller;

use Model\AuthentificationModel as AuthModel;
use Model\MailModel;
use Model\UserModel;

use \W\Security\StringUtils;
use W\Security\AuthentificationModel;

use \W\Controller\Controller;
use W\Model\Model;



class AuthentificationController extends Controller
{

    private $auth;
    private $User;
    private $Mail;
    private $errors = [];
    private  $message = [];


    public function __construct()
    {
        $this->auth = new AuthentificationModel();
        $this->User = new UserModel();
        $this->Mail = new MailModel();
    }


    public function login() {

        if(isset($_POST['login'])){
            $userCheck = $this->auth->isValidLoginInfo($_POST['email'], $_POST['password']);

            if($userCheck){
                $currentUser = $this->User->find($userCheck);
                if ($currentUser['status']) {
                    $this->auth->logUserIn($currentUser);
                    $message['login']="Vous etez bien connecté.";
                    $_SESSION['message']=$message;
                    $this->redirectToRoute('profile.home');
                } else {
                    $errors="Erreur cette utilisateur est actuellement desactivé.";
                    $this->show('Authentification/login',['errors'=> $errors]);
                }
            } else{
                $errors="Erreur l'email et le mot de passe saisie ne correspondent pas.";
                $this->show('Authentification/login',['errors'=> $errors]);
            }
        }
    }


    public function logout() {
        $this->auth->logUserOut();
        $message['logout']="Vous avez bien été déconnecté.";

        $_SESSION['message']=$message;
        $this->redirectToRoute('home');
    }



    private function envoieMailResetPassword($user_register){

        $secu_chaine = new StringUtils();
        $token=$secu_chaine->randomString();
        //$this->User->update(['token' => $token],$this->lastInsertId());
        $url=$this->generateUrl('auth.resetpassword',"",true)."?token=".$token;
        var_dump($url);

        //envoie du mail a  faire dans un model a part
        $msg="Bonjour, vous avez demandé une réinitialisation de votre mot de passe, vous pouvez le changer en cliquant sur le lien ci dessous ou le copier/coller dans votre navigateur internet  :  ".$url.".".PHP_EOL."Si vous n'avez pas          demandé cette Réinitialisation de votre mot de passe veuillez ne pas en tenir compte";


        $message_html="<p>Bonjour, vous avez demandé une réinitialisation de votre mot de passe, vous pouvez le changer en cliquant <a href='".$url."'>ici</a></p>
        <p>Si vous n'avez pas demandé cette Réinitialisation de votre mot de passe veuillez ne pas en tenir compte</p>";



        $object="[BookKeeper] - réinitialisation de votre mot de passe";

        return $this->Mail->envoieMail($user_register['email'],$msg,$message_html,$object,$user_register['username']);
    }


    private function envoieMailActivation($user_register){

        $secu_chaine = new StringUtils();
        $token=$secu_chaine->randomString();
        $this->User->update(['token' => $token],$this->User->lastInsertId());
        $url=$this->generateUrl('auth.resetpassword',"",true)."?token=".$token;
        var_dump($url);


        $msg="Bonjour ".$user_register['username'].", vous venez de vous inscrirer sur notre site, vous  pouvez maintenant          activer votre compte en cliquant sur ce lien ci-aprés : ".$url.".".PHP_EOL."Si vous n'avez pas effectué cette               inscription veuillez nous contacter.";

        $object="[BookKeeper] - Activation de votre Compte";
        return $this->Mail->envoieMail($user_register['email'],$msg,$object,$user_register['username'],"","","","");

        //var_dump(count($retour['errors-mail']));
    }

    public function register () {

        // Inscription
        if(isset($_POST['register'])){

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
                $message['register']="Vous etez bien inscrit.";
                // Envoi d'email, ajout d'un message
                $retour=$this->envoieMailActivation($user_connected);

                $_SESSION['message']=$message;
                $this->redirectToRoute('profile.home');
            } else{
                $this->show('default/home',['errors'=>$errors]);
            }
        }
    }

    public function forgetPassword ()
    {
        if (isset($_POST['forget-password'])) {

            if (!empty($_POST['email'])) {

                $email=strip_tags(trim($_POST['email']));

                if ($this->User->emailExists($email)) {

                    $retour=$this->envoieMailResetPassword($this->User->getUserByUsernameOrEmail($email));

                    if (count($retour['errors-mail'])==0){

                        $_SESSION['message']=$retour['message-mail'];

                        $this->redirectToRoute('home');
                    } else{
                        $errors['email'] = $retour['errors-mail'];
                        $this->show('Authentification/forget-password',['errors'=>$errors]);
                    }
                } else {
                    $errors['email'] = "L'email saisie est incorrect !";
                    $this->show('Authentification/forget-password',['errors'=>$errors]);
                }
            } else {
                $errors['email'] =  "Erreur email vide";
                $this->show('Authentification/forget-password',['errors'=>$errors]);

            }
        }

        $this->show('Authentification/forget-password');
    }

    public function resetPassword () {


        if (isset($_GET['token'])) {

            $authModel=new AuthModel();
            $user_token=$authModel->findToken($_GET['token']);
            //var_dump($user_token);

            if ($user_token) {
                $this->show('Authentification/reset-password',['id' => $user_token['id']]);
            } else {
                $errors['token']=" Erreur le token est incorrect";

                $_SESSION['errors']=$errors;
                $this->redirectToRoute('home');
            }

        }

        else{
            $errors['token'] = "Erreur le token est manquant";

            $_SESSION['errors']=$errors;
            $this->redirectToRoute('home');
        }

        if (isset($_POST['reset-password'])) {

            if (!empty($_POST['password'])) {

                if ($_POST['password'] == $_POST['cf-password']) {
                    $id=strip_tags($_POST['id']);
                    // a besoin de l'id du user pour mettre a jour le token
                    $this->User->update(['password' => $this->auth->hashPassword($_POST['password']), 'token' => null],$id);
                    $message="Le mot de passe a bien été mis a jour .";

                    $_SESSION['message']=$message;
                    $this->redirectToRoute('profile.home');
                } else {
                    $errors['password'] = "Erreur le password et la confirmation ne correspondent pas !";
                    $this->show('Authentification/reset-password',['errors'=>$errors]);
                }

            } else {
                $errors['password'] = "Erreur le password est vide" ;
                $this->show('Authentification/reset-password',['errors'=>$errors]);
            }

        }

        //var_dump($errors);

    }
}