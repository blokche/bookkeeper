<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title><?= $this->e($title) ?></title>
	<link rel="stylesheet" href="<?= $this->assetUrl('vendor/bootstrap/dist/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,700" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <?php echo $this->section('css') ?>
</head>
<body>	
<nav class="navbar navbar-default">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= $this->url('home') ?>"><img src="<?= $this->assetUrl('img/LogoBlancOr1.svg') ?>" alt=""></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<!--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->

				<li class="dropdown	<?php if ($w_current_route=="public.book" || $w_current_route=="public.search" || $w_current_route=="profile.book.add" ) { echo "active"; } ?>   ">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestion des livres<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li  <?php if ($w_current_route=="public.book") { echo "class='active'"; } ?>  >
							<a href="<?= $this->url('public.book',['page' => 1]) ?>">Liste des livres</a>
						</li>
						<li <?php if ($w_current_route=="public.search") { echo "class='active'"; } ?>  >
							<a href="<?= $this->url('public.search') ?>">Recherche de livres</a>
						</li>
						<?php if ($w_user): ?>
							<li <?php if ($w_current_route=="profile.book.add") { echo "class='active'"; } ?>  >
								<a href="<?= $this->url('profile.book.add') ?>">Ajouter un livre</a>
							</li>
						<?php endif; ?>
					</ul>
				</li>

				<?php if($w_user) : ?>
					<li class="dropdown <?php if ($w_current_route=="profile.bookread" || $w_current_route=="profile.bookunread" ) { echo "active"; } ?>   ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
						   aria-haspopup="true" aria-expanded="false">Ma liste de lecture<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li <?php if ($w_current_route=="profile.bookread") { echo "class='active'"; } ?> >
								<a href="<?= $this->url('profile.bookread',['page' => 1]) ?>">Mes livres lus</a>
							</li>
							<li <?php if ($w_current_route=="profile.bookunread") { echo "class='active'"; } ?>  >
								<a href="<?= $this->url('profile.bookunread',['page' => 1]) ?>">Mes livres non lus</a>
							</li>
						</ul>
					</li>
					<li  <?php if ($w_current_route=="profile.quote") { echo "class='active'"; } ?>  >
						<a href="<?= $this->url('profile.quote') ?>">Mes citations</a>
					</li>
					<li	  <?php if ($w_current_route=="profile.home") { echo "class='active'"; } ?>  >
						<a href="<?= $this->url('profile.home') ?>">Mon profil</a>
					</li>

					<?php if($w_user['role']=="admin") : ?>
						<li>
							<a href="<?= $this->url('admin.home') ?>">Gestion admin</a>
						</li>
					<?php endif; ?>
				<?php endif; ?>
				<li <?php if ($w_current_route=="public.libraries") { echo "class='active'"; } ?>  >
					<a href="<?= $this->url('public.libraries') ?>">Liste des librairies</a>
				</li>
				<?php if(empty($w_user)) :?>
					<form class="login navbar-form" action="<?= $this->url('auth.login') ?>" method="POST">
						<div class="form-group">
							<label for="email">Email:</label>
							<input id="email" name="email" type="text" class="form-nav" placeholder="Votre Pseudo">

							<label for="password">Mot de passe</label>
							<input id="password" name="password" type="password" class="form-nav" placeholder="Votre Password">
						</div>
						<button name="login" class="btn btn-default">Se connecter</button>
					</form>
						<li <?php if ($w_current_route=="profile.home") { echo "class='active'"; } ?>  >
							<a class="pull-right" href="<?= $this->url	('auth.forgetpassword') ?>">Mot de passe oublié ?</a>
						</li>
					<?php else : ?>
						<li>
							<a href=" <?= $this->url('profile.home') ?> ">Bonjour, <?= $w_user['username'] ?></a>
						</li>
						<li>
							<a href="<?= $this->url('auth.logout') ?>">Deco</a>
						</li>
				<?php endif; ?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>






    <?php if ( isset($_SESSION['message'])) : ?>
    <div class="container">
                <div class="row">
            <?php foreach ($_SESSION['message'] as $message): ?>
                    <div class="alert alert-<?= $message['type'] ?> alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><?= $message['message'] ?></strong>
                    </div>

            <?php	endforeach;
                    unset($_SESSION['message']); ?>
                    </div>
     </div>
    <?php endif; ?>
    <main class="container">
        <?= $this->section('main_content') ?>
    </main>
	<div class="container-fluid footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul>
						<li><a href="">Webforce</a></li>
						<li><a href="">A propos</a></li>
						<li><a href="">L'equipe</a></li>
						<li><a href="">S’enregistrer</a></li>
						<li><a href="">Contact</a></li>
					</ul>
					<a href=""><img class="logoBookkeeper" src="<?= $this->assetUrl('img/LogoBlancOr1.svg') ?>" alt="LogoBookkeeper"></a>
					<a href=""><img class="logoWebForce pull-right" src="<?= $this->assetUrl('img/logoWebforce.png') ?>" alt="LogoWebforce"></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<h4>&copy; Bookkeeper</h4>
				</div>
			</div>
		</div>
	</div>

	<script src="<?= $this->assetUrl('vendor\jquery\dist\jquery.min.js') ?>"></script>
	<script src="<?= $this->assetUrl('vendor\bootstrap\dist\js\bootstrap.min.js') ?>"></script>
	<script src="<?php echo $this->assetUrl('scripts/confirmdelete.js') ?>"></script>
	<?php echo $this->section('js'); ?>

</body>
</html>