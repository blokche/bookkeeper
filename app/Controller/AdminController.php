<?php

namespace Controller;

use Model\BookModel;
use Model\DatabaseModel;
use Model\QuoteModel;
use Model\CategoryModel;

use W\Controller\Controller;
use W\Model\UsersModel;

class AdminController extends Controller {


    private $user;
    private $quote;
    private $book;
    private $category;

    public function __construct()
    {
        //$this->allowTo('admin');
        $this->user = new UsersModel();
        $this->quote = new QuoteModel();
        $this->book = new BookModel();
        $this->category = new CategoryModel();
        $this->category->setTable('categories');
        $this->book->setTable('books');
        $this->quote->setTable('quotes');

    }

    public function index () {
        $totalUsers = count($this->user->findAll());
        $totalQuotes = count($this->quote->findAll());
        $totalBooks = count($this->book->findAll());

        $this->show('admin/index', [
            'totalUsers' => $totalUsers,
            'totalQuotes' => $totalQuotes,
            'totalBooks' => $totalBooks
        ]);
    }

    /**
     * Lister l'ensemble des utilisateurs
     */
    public function allUsers()
    {
        $users = $this->user->findAll();
        $this->show('admin/allusers', ['users' => $users]);
    }

    /**
     * Consulter les informations d'un utilisateur
     * @param $userid
     */
    public function viewUser($userid)
    {
        $user = $this->user->find($userid);
        if ($user) {
            $this->show('admin/userdetails.php', ['user' => $user]);
        } else {
            $this->showNotFound();
        }
    }

    /**
     * Editer un utilisateur
     * @param $userid
     */
    public function editUser($userid)
    {
        $user = $this->user->find($userid);
        if ($user) {
            if (isset($_POST['edit'])) {

            } else {
                $this->show('admin.user.edit', ['user' => $user]);
            }
        } else {
            $this->showNotFound();
        }
    }

    /**
     * Supprimer un utilisateur
     * @param $userid
     */
    public function deleteUser($userid)
    {
        $user = $this->user->find($userid);
        if ($user) {
            $this->user->delete($userid);
            $this->redirectToRoute('admin.home');
        } else {
            $this->redirectToRoute('admin.user');
        }
    }

    /**
     * Désactiver un utilisateur
     * @param $userid
     */
    public function toggleStatus ($userid)
    {
        $user = $this->user->find($userid);
        if ($user)
        {
            if ($user['status'])
            {
                $this->user->update([
                    'status' => 0
                ], $user['id']);
            } else {
                $this->user->update([
                    'status' => 1
                ], $user['id']);
            }
        } else {
            $this->redirectToRoute('admin.user');
        }
    }

    // Books Management

    /**
     * Retourner la liste de tous les livres sur le site
     */
    public function allBooks ()
    {
        $books = $this->book->findAll();
        $this->show('admin/allbooks', ['books' => $books]);
    }

    /**
     * Consulter la fichier d'un livre
     * @param $bookid
     */
    public function viewBook ($bookid)
    {
        $book = $this->book->find($bookid);

        if ($book)
        {
            $categoriesIds = $this->book->getCategoriesIds($book['id']);
            $categories = $this->book->getCategories($categoriesIds);
            $this->show('admin/bookdetails', ['book' => $book, 'categories' => $categories]);
        } else {
            $this->redirectToRoute('admin.book');
        }
    }

    /**
     * Editer une fiche livre
     * @param $bookid
     */
    public function editBook ($bookid)
    {

        $book = $this->book->find($bookid);

        if ($book)
        {
            $categoriesAll = $this->category->findAll();
            // Récupération de toutes les catégories
            $categoriesIds = $this->book->getCategoriesIds($book['id']);
            // Ids des catégories du livre consulté

            $categoriesIds =  array_map(function($arr) {
                return $arr['category_id'];
            }, $categoriesIds);

            if (isset($_POST['edit']))
            {
                // Ajout de l'image si elle est différente ou existante
                if (isset($_FILES['cover']) && !empty($_FILES['cover']['name']))
                {
                    $extensions = ['jpeg', 'jpg', 'git', 'png'];
                    $docInfos = pathinfo($_FILES['cover']['name']);

                    $name = strtolower($docInfos['filename'])."-".time().".".$docInfos['extension'];

                    if (in_array($docInfos['extension'], $extensions) && $_FILES['cover']['size'] < 2500000) {
                        if  (move_uploaded_file($_FILES['cover']['tmp_name'], __DIR__."/../../public/upload/cover/".$name)) {
                            $this->book->update(['cover' => $name], $book['id']);
                        }
                    }
                }

                // Gestion du status
                if (isset($_POST['active']))
                {
                    $this->book->update([
                        'status' => 1
                    ], $book['id']);
                } else {
                    $this->book->update([
                        'status' => 0
                    ], $book['id']);
                }

                // Update du titre et de l'auteur
                $this->book->update([
                    'title' => $_POST['title'],
                    'author' => $_POST['author']
                ], $book['id']);

                // Update des catégories
                if (isset($_POST['categories']))
                {
                    $this->book->deleteCategories($book['id']);
                    foreach($_POST['categories'] as $category)
                    {
                        $this->book->addCategories($book['id'], $category);
                    }
                }

                $this->redirectToRoute('admin.book.view', ['id' => $book['id']]);

            } else {
                $this->show('admin/editbook', ['book' => $book, 'categoriesBook' => $categoriesIds, 'categories' => $categoriesAll]);
            }
        } else {
            $this->showNotFound();
        }
    }

    /**
     * Ajouter un livre
     */
    public function addBook ()
    {
        $userId=  $this->getUser()['id'];
        $categories = $this->category->findAll();

        if (isset($_POST['addbook']))
        {

            if ( !empty($_POST['author']) && !empty($_POST['title']) )
            {
                $book = $this->book->insert([
                    'author' => $_POST['author'],
                    'title' => $_POST['title'],
                    'created_by' => $userId
                ]);

                if (isset($_POST['categories']))
                {
                    foreach($_POST['categories'] as $category)
                    {
                        $this->book->addCategories($book['id'], $category);
                    }
                }

                if (isset($_FILES['cover']) && !empty($_FILES['cover']['name']))
                {
                    $extensions = ['jpeg', 'jpg', 'git', 'png'];
                    $docInfos = pathinfo($_FILES['cover']['name']);

                    $name = strtolower($docInfos['filename'])."-".time().".".$docInfos['extension'];

                    if (in_array($docInfos['extension'], $extensions) && $_FILES['cover']['size'] < 2500000)
                    {
                        if  (move_uploaded_file($_FILES['cover']['tmp_name'], __DIR__."/../../public/upload/cover/".$name)) {
                            $this->book->update(['cover' => $name], $book['id']);
                        }
                    }
                }

            } else {
                $this->redirectToRoute("admin.book.add");
            }

            $this->redirectToRoute('admin.book.view', ['id' => $book['id']]);
        } else {
            
            $this->show('admin/addbook', ['categories' => $categories]);
        }
    }

    /**
     * Supprimer un livre
     * @param $bookid
     */
    public function deleteBook ($bookid)
    {
        $book = $this->book->find($bookid);

        if (isset($_POST['deletebook']))
        {
            if ($book)
            {
                $this->book->deleteCategories($book['id']);
                if ($this->book->delete($book['id'])) {

                    $this->redirectToRoute('admin.book');
                } else {
                    $this->redirectToRoute('admin.book.edit', ['id' => $book['id']]);
                }
            }
            else {
                $this->redirectToRoute('admin.book');
            }
        }
        else {
            $this->redirectToRoute('admin.book.edit', ['id' => $bookid]);
        }
    }

    // Category management

    /**
     *  Récupérer l'ensemble des catégories
     */
    public function allCategories ()
    {
        $categories = $this->category->findAll();
        $this->show('admin/allcategories', ['categories' => $categories]);
    }

    /**
     * Ajouter une catégorie
     */
    public function addCategory ()
    {
        if (isset($_POST['addcategories']) && !empty($_POST['label']))
        {
            $label = trim($_POST['label']);
            if ($this->category->insert([
                'label' => $label
            ])) {
                $this->redirectToRoute('category.home');
            }

        }
        $this->show('admin/addcategory');
    }

    /**
     * Editer une catégorie
     * @param $catid
     */
    public function editCategory ($catid) {
        $category = $this->category->find($catid);

        if ($category)
        {
            if (isset($_POST['editcategory']))
            {
                if (isset($_POST['label']) && strlen($_POST['label']) > 0) {
                    if ($this->category->update([
                        'label' => $_POST['label']
                    ], $category['id']))
                    {
                        $this->redirectToRoute("category.home");
                    }
                }
            } else {
                $this->show('admin/editcategory', ['category' => $category]);
            }
        } else {
         $this->redirectToRoute('category.home');
        }
    }

    /**
     * Supprimer une catégorie
     * @param $catid
     */
    public function deleteCategory ($catid)
    {
        if (isset($_POST['deletecategory']))
        {
            $category = $this->category->find($catid);

            if ($category)
            {
                if ($this->category->delete($category['id']))
                {
                    $this->redirectToRoute('category.home');
                }
            } else {
                $this->redirectToRoute('category.home');
            }
        } else {
            $this->redirectToRoute('category.home');
        }
    }


}