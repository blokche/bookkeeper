<?php

define('__ROOT__', dirname(__DIR__ ));
	$w_routes = array(

		// Public
		['GET', '/', 'Default#home', 'home'],


		['GET', '/book/page/[i:page]', 'Default#allBooks', 'public.book'],
		['GET', '/book/[i:id]', 'Default#bookById', 'public.view'],
		['GET|POST', '/search', 'Default#searchBook', 'public.search'],
		['GET', '/libraries', 'Default#libraries', 'public.libraries'],



		// Authentification
		['POST', '/login', 'AuthentificationController#login', 'auth.login'],
		['GET', '/logout', 'AuthentificationController#logout', 'auth.logout'],
		['POST', '/register', 'AuthentificationController#register', 'auth.register'],
		['GET|POST', '/forget-password', 'AuthentificationController#forgetPassword', 'auth.forgetpassword'],
		['GET|POST', '/reset-password', 'AuthentificationController#resetPassword','auth.resetpassword'],
		['GET', '/activate-account', 'AuthentificationController#activateAccount','auth.activateaccount'],



		// Admin
		['GET', '/admin', 'AdminController#index', 'admin.home'],

		['GET', '/admin/user', 'AdminController#allUsers', 'admin.user'],
		['GET', '/admin/user/[i:id]', 'AdminController#viewUser', 'admin.user.view'],
		['GET|POST', '/admin/user/[i:id]/edit', 'AdminController#editUser', 'admin.user.edit'],
		['POST', '/admin/user/[i:id]/delete', 'AdminController#deleteUser', 'admin.user.delete'],


		['GET', '/admin/book', 'AdminController#allBooks', 'admin.book'],
		['GET', '/admin/book/[i:id]', 'AdminController#viewBook', 'admin.book.view'],
		['GET|POST', '/admin/book/add', 'AdminController#addBook', 'admin.book.add'],
		['GET|POST', '/admin/book/[i:id]/edit', 'AdminController#editBook', 'admin.book.edit'],
		['POST', '/admin/book/[i:id]/delete', 'AdminController#deleteBook', 'admin.book.delete'],

		['GET', '/admin/category', 'AdminController#allCategories', 'category.home'],
		['GET|POST', '/admin/category/add', 'AdminController#addCategory', 'category.add'],
		['GET|POST', '/admin/category/[i:id]/edit', 'AdminController#editCategory', 'category.edit'],
		['POST', '/admin/category/[i:id]/delete', 'AdminController#deleteCategory', 'category.delete'],



		// Profile
		['GET', '/profile', 'ProfileController#index', 'profile.home'],
		['GET|POST', '/profile/edit', 'ProfileController#editProfile', 'profile.edit'],
		['POST', '/profile/delete', 'ProfileController#deleteProfile', 'profile.delete'],
		['GET|POST', '/profile/search', 'ProfileController#search', 'profile.search'],


		//BookControler
		['GET', '/profile/book/[i:page]', 'BooksController#viewBooks', 'profile.book'],
		['GET|POST', '/profile/book/add', 'BooksController#addBook', 'profile.book.add'],
		['GET', '/profile/book/[i:id]/delete', 'BooksController#deleteBook', 'profile.book.delete'],
		['GET', '/profile/book/[i:id]/toggleread/[i:status]', 'BooksController#toggleRead', 'profile.book.toggleread'],


		//QuoteController
		['GET', '/profile/quote/page', 'QuotesController#allQuotes', 'profile.quote'],
		['GET|POST', '/profile/quote/add', 'QuotesController#addQuote', 'profile.quote.add'],
		['GET|POST', '/profile/quote/[i:id]/edit', 'QuotesController#editQuote', 'profile.quote.edit'],
		['POST', '/profile/quote/[i:id]/delete', 'QuotesController#deleteQuote', 'profile.quote.delete'],



	);