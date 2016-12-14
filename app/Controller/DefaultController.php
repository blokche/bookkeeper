<?php

namespace Controller;

use Model\BookModel;
use \W\Controller\Controller;

class DefaultController extends Controller
{

	private $book;
	private $quote;

	public function __construct()
	{
		$this->book = new BookModel();
		$this->book->setTable('books');
	}

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{
		$this->show('default/home');
	}

	/**
	 * Récupérer la liste des livres
	 * @param int $page
	 */
	public function allBooks($page = 1)
	{

		$perPage = 2;

		$total = count($this->book->findAll());
		$nbPages = (int) ceil($total / $perPage);

		if ($page <= 0) {
			$page = 1;
		}

		if ($page > $nbPages) {
			$page = $nbPages;
		}

		$offset = $perPage * ($page - 1);
		$books = $this->book->findAll('id', 'DESC', $perPage, $offset);

		$this->show('default/books', ['books' => $books, 'nbpages' => $nbPages, 'page' => $page]);

	}

	/**
	 * Voir la fiche d'un livre
	 * @param $id
	 */
	public function bookById($id)
	{
		$book = $this->book->find($id);

		if ($book) {
			$this->show('default/viewbook.php', ['book' => $book]);
		} else {
			$this->showNotFound();
		}
	}

	public function searchBook () {

		if (isset($_POST['search']))
		{
			$searchTerm = strip_tags($_POST['q']);
			if (strlen($searchTerm) > 0)
			{
				$results = $this->book->searchBook($searchTerm);

				$this->show('default/search', [
					'searchTerm' => $searchTerm,
					'results' => $results
				]);
			} else {
				$this->redirectToRoute('public.search');
			}
		}

		$this->show('default/search');
	}

	public function libraries () {
		$this->show('default/libraries');
	}

}