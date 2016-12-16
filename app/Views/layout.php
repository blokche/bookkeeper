<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>

	<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
	<div class="container">
			<div class="nav container-fluid">
				<div class="container">
					<a href="<?= $this->url('home') ?>"><img src="<?= $this->assetUrl('img/LogoBlancOr1.svg') ?>" alt=""></a>
					<a href="<?= $this->url('public.book',['page' => 0]) ?>">Liste des livres</a>
					<a href="<?= $this->url('public.libraries') ?>">Liste des librairies</a>
					<a href="<?= $this->url('public.search') ?>">Recherche de livres</a>

					<?php if($w_user) : ?>

						<a href="<?= $this->url('profile.book',['page' => 0]) ?>">Ma liste de lecture</a>
						<a href="<?= $this->url('profile.quote') ?>">Mes citations</a>
						<a href="<?= $this->url('profile.home') ?>">Mon profile</a>

						<?php if($w_user['role']=="admin") : ?>
							<a href="<?= $this->url('profile.home') ?>"></a>
						<?php endif; ?>
					<?php endif; ?>
					<div class="login pull-right">
						<?php if(empty($w_user)) :?>

							<form action="<?= $this->url('auth.login') ?>" method="POST">
								<label for="email">Email:</label>
								<input id="email" name="email" type="text" class="form-nav" placeholder="Votre Pseudo">

								<label for="password">Mot de passe</label>
								<input id="password" name="password" type="password" class="form-nav" placeholder="Votre Password">
								<button name="login" class="btn btn-default">Se connecter</button>
							</form>

							<a class="pull-right" href="<?= $this->url('auth.forgetpassword') ?>">Mot de passe oublié ?</a>
						<?php   else : ?>
							<a href="<?= $this->url('profile.home') ?>">Bonjour, <?= $w_user['username'] ?></a>
							<a href="<?= $this->url('auth.logout') ?>">Deco</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

	<div class="container-fluid">
		<section>
			<?= $this->section('main_content') ?>
		</section>

		<footer>
		</footer>
	</div>
	<?php echo $this->section('js'); ?>
</body>
</html>