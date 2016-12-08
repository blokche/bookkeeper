<?php

namespace Controller;

use W\Security\AuthentificationModel;
use \W\Controller\Controller;

class AuthentificationController extends Controller
{

    private $auth;

    public function __construct()
    {
        $this->auth = new AuthentificationModel();
    }

    public function login() {

    }

    public function logout() {

    }

    public function register () {

    }

    public function forgetPassword () {

    }

    public function resetPassword () {

    }
    
}