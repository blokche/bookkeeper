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
    private $authmodel;
    private $user;
    private $mail;
    private $errors = [];
    private  $message = [];


    public function __construct()
    {
        $this->authmodel= new AuthModel();
        $this->auth = new AuthentificationModel();
        $this->user = new UserModel();
        $this->mail = new MailModel();
    }


    public function login() {

        if(isset($_POST['login'])){
            $userCheck = $this->auth->isValidLoginInfo($_POST['email'], $_POST['password']);

            if($userCheck){
                $currentUser = $this->user->find($userCheck);
                if ($currentUser['status']) {
                    $this->auth->logUserIn($currentUser);
                    $this->message['login']="Vous etez bien connecté.";
                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute('profile.home');
                } else {
                    $this->errors['login']="Erreur cette utilisateur est actuellement desactivé ou n'as pas encore été activé.";
                    $_SESSION['errors']=$this->errors['login'];
                    $this->redirectToRoute('home');
                }
            } else{
                $this->errors['login']="Erreur l'email et le mot de passe saisie ne correspondent pas.";
                $_SESSION['errors']=$this->errors['login'];
                $this->redirectToRoute('home');
            }
        }
    }


    public function logout() {
        $this->auth->logUserOut();
        $this->message['logout']="Vous avez bien été déconnecté.";

        $_SESSION['message']=$this->message;
        $this->redirectToRoute('home');
    }



    private function envoieMailResetPassword($user){

        $secu_chaine = new StringUtils();
        $token=$secu_chaine->randomString();
        $this->user->update(['status' => 1,'token' => $token],$user['id']);
        $url=$this->generateUrl('auth.resetpassword',"",true)."?token=".$token;
        var_dump($url);

        //envoie du mail a  faire dans un model a part
        $msg="Bonjour ".$user['username'].", vous avez demandé une réinitialisation de votre mot de passe, vous pouvez le changer en cliquant sur le lien ci dessous ou le copier/coller dans votre navigateur internet  :  ".$url.".".PHP_EOL."Si vous n'avez pas          demandé cette Réinitialisation de votre mot de passe veuillez ne pas en tenir compte";


        $message_html="<p>Bonjour ".$user['username'].", vous avez demandé une réinitialisation de votre mot de passe, vous pouvez le changer en cliquant <a href='".$url."'>ici</a></p>
        <p>Si vous n'avez pas demandé cette Réinitialisation de votre mot de passe veuillez ne pas en tenir compte</p>";



        $object="[BookKeeper] - réinitialisation de votre mot de passe";

        return $this->mail->envoieMail($user['email'],$msg,$message_html,$object,$user['username']);
    }


    private function envoieMailActivation($user_register){

        $secu_chaine = new StringUtils();
        $token=$secu_chaine->randomString();
        $this->user->update(['token' => $token],$user_register['id']);
        $url=$this->generateUrl('auth.activateaccount',"",true)."?token=".$token;
        var_dump($url);


        $msg="Bonjour ".$user_register['username'].", vous venez de vous inscrirer sur notre site, vous pouvez activer votre compte en cliquant sur le lien ci dessous ou le copier/coller dans votre navigateur internet  : ".$url.".".PHP_EOL."Si vous n'avez pas effectué cette inscription veuillez nous contacter.";

        $message_html="<p>Bonjour ".$user_register['username'].", vous venez de vous inscrirer sur notre site, vous pouvez activer votre compte en cliquant <a href='".$url."'>ici</a></p>
        <p>Si vous n'avez pas demandé cette Réinitialisation de votre mot de passe veuillez ne pas en tenir compte</p>";

        $object="[BookKeeper] - Activation de votre Compte";
        return $this->mail->envoieMail($user_register['email'],$msg,$message_html,$object,$user_register['username']);

        //var_dump(count($retour['errors-mail']));
    }

    public function register () {

        // Inscription
        if(isset($_POST['register'])){

            $this->errors['email'] = (empty($_POST['email'])) ? "Erreur email vide" : null;
            $this->errors['username'] = (empty($_POST['username'])) ? "Erreur username vide" : null;
            $this->errors['password'] = (empty($_POST['password'])) ? "Erreur password vide" : null;

            if($_POST['password'] != $_POST['cf-password'])
            {
                $this->errors['cf-password'] = "Erreur password et confirmation ne correspond pas";
            }

            if($this->user->emailExists($_POST['email']) || $this->user->usernameExists($_POST['username'])){
                $this->errors['validity'] = "Username or email exists.";
            }

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)==false){
                $this->errors['email']="Erreur l'email saisie est invalide";
            }


            if(count(array_unique($this->errors))== 1){

                $user_connected=[
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $this->auth->hashPassword($_POST['password']),
                    'status' => 0
                ];

                $user_connected=$this->user->insert($user_connected);
                $this->auth->logUserIn($user_connected);
                $this->message['register']="Vous etez bien inscrit.";
                $retour=$this->envoieMailActivation($user_connected);

                var_dump(isset($retour['errors-mail']));

                if (!isset($retour['errors-mail'])){

                    $this->message['email'] = $retour['message-mail'];
                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute('home');

                } else{

                    $this->errors['email'] = $retour['errors-mail'];
                    $this->show('default/home',['errors' => $this->errors]);
                }
            } else{
                $this->show('default/home',['errors' => $this->errors]);
            }
        }
    }

    public  function activateAccount(){

        if (isset($_GET['token'])) {

            $user_token=$this->authmodel->findToken($_GET['token']);
            //var_dump($user_token);

            if ($user_token) {
                $this->message['activation']="Votre compte a bien été activée, vous etez maintenant connecté.";
                $this->user->update(['token' => null],$user_token['id']);
                $_SESSION['message']=$this->message['activation'];
                $this->redirectToRoute('profile.home');
            } else {
                $this->errors['token']=" Erreur le token est incorrect";

                $_SESSION['errors']=$this->errors;
                $this->redirectToRoute('home');
            }

        }

        else{
            $this->errors['token'] = "Erreur le token est manquant";

            $_SESSION['errors']=$this->errors;
            $this->redirectToRoute('home');
        }
    }

    public function forgetPassword ()
    {
        if (isset($_POST['forget-password'])) {

            if (!empty($_POST['email'])) {

                $email=strip_tags(trim($_POST['email']));

                if ($this->user->emailExists($email)) {

                    $retour=$this->envoieMailResetPassword($this->user->getUserByUsernameOrEmail($email));

                    if (!isset($retour['errors-mail'])){

                        $_SESSION['message']=$retour['message-mail'];

                        $this->redirectToRoute('home');
                    } else{
                        $this->errors['email'] = $retour['errors-mail'];
                        $this->show('Authentification/forget-password',['errors'=>$this->errors]);
                    }
                } else {
                    $this->errors['email'] = "L'email saisie est incorrect !";
                    $this->show('Authentification/forget-password',['errors'=>$this->errors]);
                }
            } else {
                $this->errors['email'] =  "Erreur email vide";
                $this->show('Authentification/forget-password',['errors'=>$this->errors]);

            }
        }

        $this->show('Authentification/forget-password');
    }

    public function resetPassword () {

        
        if (isset($_POST['reset-password'])) {

            if (!empty($_POST['password'])) {

                if ($_POST['password'] == $_POST['cf-password']) {
                    $id=strip_tags($_POST['id']);
                    $this->user->update(['password' => $this->auth->hashPassword($_POST['password']), 'token' => null],$id);
                    $this->message="Le mot de passe a bien été mis a jour .";

                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute('profile.home');
                } else {
                    $this->errors['password'] = "Erreur le password et la confirmation ne correspondent pas !";
                    $_SESSION['errors']=$this->errors['token'];
                    $this->show('Authentification/reset-password',['errors'=>$this->errors]);
                }

            } else {
                $this->errors['password'] = "Erreur le password est vide" ;
                $_SESSION['errors']=$this->errors['token'];
                $this->show('Authentification/reset-password',['errors'=>$this->errors]);
            }

        }


        if (isset($_GET['token'])) {

            $user_token=$this->authmodel->findToken(strip_tags($_GET['token']));
            //var_dump($user_token);

            if ($user_token) {
                $this->show('Authentification/reset-password',['id' => $user_token['id']]);
            }

            else {
                $errors['token']=" Erreur le token est incorrect";
                $_SESSION['errors']=$this->errors['token'];
                $this->redirectToRoute('home');
            }

        }

        else{
            $errors['token'] = "Erreur le token est manquant";
            $_SESSION['errors']=$this->errors['token'];
            $this->redirectToRoute('home');
        }

    }

}