<?php
	
	$w_routes = array(

		// Public
		['GET', '/', 'Default#home', 'home'],


		['GET', '/book/page/[i:page]', 'Default#allBooks', 'public.book'],
		['GET', '/book/[i:id]', 'Default#bookById', 'public.book'],
		['GET|POST', '/search', 'Default#searchBook', 'public.search'],
		['GET', '/libraries', 'Default#libraries', 'public.libraries'],



		// Authentification
		['POST', '/login', 'AuthentificationController#login', 'auth.login'],
		['POST', '/logout', 'AuthentificationController#logout', 'auth.logout'],
		['POST', '/register', 'AuthentificationController#register', 'auth.register'],
		['GET|POST', '/forget-password', 'AuthentificationController#forgetPassword', 'auth.forgetpassword'],
		['GET|POST', '/reset-password', 'AuthentificationController#resetPassword','auth.resetpassword'],



		// Admin
		['GET', '/admin', 'AdminController#index', 'admin.home'],

		['GET', '/admin/user/page/[i:page]', 'AdminController#allUsers', 'admin.user'],
		['GET', '/admin/user/[i:id]', 'AdminController#viewUser', 'admin.user.view'],
		['GET|POST', '/admin/user/[i:id]/edit', 'AdminController#editUser', 'admin.user.edit'],
		['POST', '/admin/user/[i:id]/delete', 'AdminController#deleteUser', 'admin.user.delete'],
		['POST', '/admin/user/[i:id]/togglestatus', 'AdminController#toggleStatus', 'admin.user.togglestatus'],


		['GET', '/admin/book/page/[i:page]', 'AdminController#allBooks', 'admin.book'],
		['GET', '/admin/book/[i:id]', 'AdminController#viewBook', 'admin.book.view'],
		['GET|POST', '/admin/book/add', 'AdminController#addBook', 'admin.book.add'],
		['GET|POST', '/admin/book/[i:id]/edit', 'AdminController#editBook', 'admin.book.edit'],
		['POST', '/admin/book/[i:id]/delete', 'AdminController#deleteBook', 'admin.book.delete'],

		['GET', '/admin/category', 'AdminController#allCategories', 'category.home'],
		['GET|POST', '/admin/category/[i:id]/edit', 'AdminController#editCategory', 'category.edit'],
		['POST', '/admin/category/[i:id]/delete', 'AdminController#deleteCategory', 'category.delete'],


		
		// Profile
		['GET', '/profile', 'ProfileController#index', 'profile.home'],
		['GET|POST', '/profile/edit', 'ProfileController#editProfile', 'profile.edit'],
		['POST', '/profile/delete', 'ProfileController#deleteProfile', 'profile.delete'],

		['GET', '/profile/book/[i:page]', 'ProfileController#viewBooks', 'profile.book'],
		['GET|POST', '/profile/book/add', 'ProfileController#addBook', 'profile.book.add'],
		['POST', '/profile/book/[i:id]/delete', 'ProfileController#deleteBook', 'profile.book.delete'],
		['POST', '/profile/book/[i:id]/toggleread', 'ProfileController#toggleRead', 'profile.book.toggleread'],

		['GET', '/profile/quote/page/[i:page]', 'ProfileController#allQuotes', 'profile.quote'],
		['GET|POST', '/profile/quote/add', 'ProfileController#addQuote', 'profile.quote.add'],
		['GET|POST', '/profile/quote/[i:id]/edit', 'ProfileController#editQuote', 'profile.quote.edit'],
		['POST', '/profile/quote/[i:id]/delete', 'ProfileController#deleteQuote', 'profile.quote.delete'],

		['GET|POST', '/profile/search', 'ProfileController#search', 'profile.search'],


	);