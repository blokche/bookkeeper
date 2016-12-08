<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show('default/home');
	}

	/**
	 * @param int $page
	 */
	public function allBooks($page = 1) {

	}

	/**
	 * @param $id
	 */
	public function bookById($id) {

	}

	public function searchBook () {

	}

	public function libraries () {

	}

}