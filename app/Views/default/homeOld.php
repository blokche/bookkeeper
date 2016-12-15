<?php $this->layout('layout', ['title' => 'Accueil']) ?>


<?php $this->start('main_content') ?>
	<h1></h1>
	<?php
	//unset($_SESSION['errors']);
	unset($_SESSION['message']);

?>
	<form action="<?= $this->url('auth.login') ?>" method="POST">
		<div class="form-group">
			<label for="email">Email :</label>
			<input id="email" name="email" type="text" class="form-control">
		</div>

		<div class="form-group">
			<label for="password">Mot de passe :</label>
			<input id="password" name="password" type="password" class="form-control">
		</div>

		<button name="login" class="btn btn-default">Se connecter</button>
		<a href="<?= $this->url('auth.forgetpassword') ?>">Récupérer mon mot de passe</a>
	</form>

	<br><br>

	<form action="<?= $this->url('auth.register') ?>" method="POST">
		<div class="form-group">
			<label for="email">Email :</label>
			<input id="email" name="email" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="username">Username :</label>
			<input id="username" name="username" type="text" class="form-control">
		</div>
		<div class="form-group">
			<label for="password">Mot de passe :</label>
			<input id="password" name="password" type="password" class="form-control">
		</div>
		<div class="form-group">
			<label for="cf-password">Confirmer le mot de passe :</label>
			<input id="cf-password" name="cf-password" type="password" class="form-control">
		</div>
		<button name="register" class="btn btn-default">S'inscrire</button>
	</form>
<?php $this->stop('main_content') ?>