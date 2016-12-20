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
<?php $this->insert('default/menu') ;?>

<main class="container">
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

<script src="<?php echo $this->assetUrl('vendor\jquery\dist\jquery.min.js') ?>"></script>
<script src="<?php echo $this->assetUrl('vendor\bootstrap\dist\js\bootstrap.min.js') ?>"></script>
<script src="<?php echo $this->assetUrl('scripts/confirmdelete.js') ?>"></script>
<?php echo $this->section('js'); ?>

</body>
</html>