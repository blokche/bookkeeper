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

                    $this->message[]=['type' => 'success', 'message' => 'Vous etez bien connecté.'];
                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute('profile.home');
                } else {
                    $this->message[]=['type' => 'warning', 'message' => 'Cette utilisateur est actuellement desactivé ou n\'as pas encore été activé.'];
                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute('home');
                }
            } else{
                $this->message[]=['type' => 'warning', 'message' => 'L\'email et le mot de passe saisie ne correspondent pas.'];
                $_SESSION['message']=$this->message;
                $this->redirectToRoute('home');
            }
        }
    }


    public function logout() {

        $this->auth->logUserOut();
        $this->message[]=['type' => 'success', 'message' => 'Vous avez bien été déconnecté.'];
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
            
            if (empty($_POST['email'])) {
                $this->message[] = ['type' => 'warning', 'message' => 'Le champ email est vide'];
            }


            if (empty($_POST['password'])) {
                $this->message[] = ['type' => 'warning', 'message' => 'Le champ mot de passe est vide'];
            }
            if (empty($_POST['username'])) {
                $this->message[] = ['type' => 'warning', 'message' => 'Le champ username est vide'];
            }


            if($_POST['password'] != $_POST['cf-password'])
            {
                $this->message[] = ['type' => 'warning', 'message' => 'Le mot de passe et la confirmation ne correspondent pas'];
            }

            if($this->user->emailExists($_POST['email'])) {
                $this->message[] = ['type' => 'warning', 'message' => "l'email saisie est déja pris par quelqu'un d'autre, veuillez en saisir un autre."];
            }

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)==false) {
                $this->message[] = ['type' => 'warning', 'message' => "l'email saisie est déja pris par quelqu'un d'autre, veuillez en saisir un autre."];
            }


            //if(count(array_unique($this->errors))== 1){
            if(!isset($this->message[0])) {

                $user_connected=[
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $this->auth->hashPassword($_POST['password']),
                    'status' => 0
                ];

                $user_connected=$this->user->insert($user_connected);
                $this->auth->logUserIn($user_connected);
                $this->message[]=['type' => 'success', 'message' => 'Vous etez bien inscrit.'];
                $retour=$this->envoieMailActivation($user_connected);

                //var_dump(isset($retour['errors-mail']));

                if ($retour['type']=="success") {

                    $this->message[]=$retour;
                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute('home');

                } else{

                    $this->message[]=$retour;
                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute('home');
                }
            } else{
                $this->show('default/home');
            }
        }
    }

    public  function activateAccount(){

        if (isset($_GET['token'])) {

            $user_token=$this->authmodel->findToken($_GET['token']);
            //var_dump($user_token);

            if ($user_token) {

                $this->user->update(['token' => null],$user_token['id']);
                $this->message[] = ['type' => 'success', 'message' => "Votre compte a bien été activée, vous etez maintenant connecté."];
                $_SESSION['message']=$this->message;
                $this->redirectToRoute('profile.home');
            } else {
                
                $this->message[] = ['type' => 'warning', 'message' => "Le token est incorrect"];
                $_SESSION['message']=$this->message;
                $this->redirectToRoute('home');
            }

        }

        else{
            
            $this->message[] = ['type' => 'warning', 'message' => "Le token est manquant"];
            $_SESSION['message']=$this->message;
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

                    //if (!isset($retour['errors-mail'])){
                    if ($retour['type']=="success") {

                        $this->message[]=$retour;
                        $_SESSION['message']=$this->message;
                        $this->redirectToRoute('home');
                    } else{

                        $this->message[]=$retour;
                        $_SESSION['message']=$this->message;
                        $this->show('Authentification/forget-password');
                    }
                } else {

                    $this->message[]=['type' => 'warning', 'message' => "L'email saisie est introuvable !"];
                    $_SESSION['message']=$this->message;
                    $this->show('Authentification/forget-password');
                }
            } else {

                $this->message[]=['type' => 'warning', 'message' => "Le champ email est vide !"];
                $_SESSION['message']=$this->message;
                $this->show('Authentification/forget-password');
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
                    $this->message = ['type' => 'success', 'message' => "Le mot de passe a bien été mis a jour ."];
                    $_SESSION['message']=$this->message;
                    $this->redirectToRoute('profile.home');
                } else {

                    $this->message[]=['type' => 'warning', 'message' => "Le mot de passe et la confirmation ne correspondent pas !"];
                    $_SESSION['message']=$this->message;
                    $this->show('Authentification/reset-password');
                }

            } else {

                $this->message[]=['type' => 'warning', 'message' => "Le champ mot passe est vide !"];
                $_SESSION['message']=$this->message;
                $this->show('Authentification/reset-password');
            }

        }


        if (isset($_GET['token'])) {

            $user_token=$this->authmodel->findToken(strip_tags($_GET['token']));

            if ($user_token) {

                $this->show('Authentification/reset-password');
            }

            else {

                $this->message[]=['type' => 'warning', 'message' => "Le token est incorrect"];
                $_SESSION['message']=$this->message;
                $this->redirectToRoute('home');
            }
        }

        else{

            $this->message[]=['type' => 'warning', 'message' => "Le token est manquant"];
            $_SESSION['message']=$this->message;
            $this->redirectToRoute('home');
        }

    }

}