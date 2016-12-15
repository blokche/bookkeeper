<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bookkeeper</title>
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
    <link rel="stylesheet" href="<?= $this->assetUrl('vendor/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,400i,700" rel="stylesheet">
</head>
<body>
<?php unset($_SESSION['message']);?>

        <div class="nav container-fluid blanc">
            <div class="container">
                <a href="<?= $this->url('home') ?>"><img src="<?= $this->assetUrl('img/LogoNoirOr.svg') ?>" alt=""></a>
                <div class="login pull-right">
                    <?php if(empty($w_user)) {?>
                    <form action="<?= $this->url('auth.login') ?>" method="POST">
                        <label for="email">Email:</label>
                        <input id="email" name="email" type="text" class="form-nav" placeholder="Votre Pseudo">

                        <label for="password">Mot de passe</label>
                        <input id="password" name="password" type="password" class="form-nav" placeholder="Votre Password">
                        <button name="login" class="btn btn-default">Se connecter</button>
                    </form>
                    <a class="pull-right" href="<?= $this->url('auth.forgetpassword') ?>">Mot de passe oublié ?</a>
                    <?php   } else { ?>
                    <a href="<?= $this->url('profile.home') ?>">Bonjour, <?= $w_user['username'] ?></a>
                    <a href="<?= $this->url('auth.logout') ?>">Deco</a>
                    <?php } ?>
                </div>
            </div>
        </div>
<?php if(empty($w_user)) {?>
<div class="background">
        <div class="container-fluid home-register">
            <div class="row">

                <div class="text-presentation col-xs-12 col-sm-12 col-md-8">
                    <p>Bookkeeper, un gestionnaire de livres vous permettant d'améliorer votre expérience de lecteur. En effet, avec un système d'enregistrement de vos livres lus, vous gardez un souvenir indélébile de vos citations préférées.
                        De plus, Bookkeepper met à votre disposition une file d'attente pour vos lectures future ainsi que les bibliothèques de la métropole lilloise afin de vous procurer les livres de toutes vos envies...
                    </p>
                </div>

                <div class="form-register col-xs-12 col-sm-12 col-md-4">
                    <form action="<?= $this->url('auth.register') ?>" method="POST">
                        <div class="row ">
                            <div class="form-group col-xs-11">
                                <h1>S’enregistrer</h1>
                            </div>
                            <div class="form-group col-xs-11">
                                <input id="username" name="username" type="text" class="form-control input-register" placeholder="Votre Pseudo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-11">
                                <input id="email-register" name="email" type="text" class="form-control input-register" placeholder="Votre Email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-11">
                                <input id="password-register" name="password" type="password" class="form-control input-register" placeholder="Mot de passe :">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-11">
                                <input id="cf-password" name="cf-password" type="password" class="form-control input-register" placeholder="Confirmer le mot de passe :">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2 ">
                                <button name="register" type="submit" class="btn-subscribe">Inscription</button>
                            </div>
                            <div class="col-xs-3 col-xs-offset-1">
                                <button  type="submit" class="btn-transparent">Continuer sans inscription</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php   } ?>
        <div class="container">
            <hr class="hr-icons">
            <div class="row icons">
                <div class="col-xs-12 col-sm-6 col-md-3 text-center icon">
                    <a href="<?= $this->url('public.book',['page' => 1]) ?>"><div class="block-logo"><img src="<?= $this->assetUrl('img/logoMaListe.svg')?>" alt=""></div></a>
                    <h3>Liste des Livres</h3>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 text-center icon">
                    <a href="<?= $this->url('profile.quote') ?>"><div class="block-logo"><img src="<?= $this->assetUrl('img/logoCitation.svg')?>" alt=""></div></a>
                    <h3>Mes Citations</h3>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 text-center icon">
                    <a href="<?= $this->url('profile.home') ?>"><div class="block-logo"><img src="<?= $this->assetUrl('img/logoProfil.svg')?>" alt=""></div></a>
                    <h3>Profil</h3>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 text-center icon">
                    <div class="block-logo"><img src="<?= $this->assetUrl('img/logoBibliothèque.svg')?>" alt=""></div>
                    <h3>Les Bibliothèques</h3>
                </div>
            </div>
            <hr class="hr-icons">
        </div>


        <div class="container-fluid tuto">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 screentuto">
                        <img src="<?= $this->assetUrl('img/tuto1.png')?>" alt="">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <ul>
                            <li>
                                <p>1 - Recherchez vos lectures à venir</p>
                            </li>
                            <li>
                                <p>2 - Ajoutez les à votre liste</p>
                            </li>
                            <li>
                                <p>3 - Lisez les</p>
                            </li>
                            <li>
                                <p>4 - Enregister vos passages preferés</p>
                            </li>
                            <li>
                                <p>5 - Recommencez !</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container recent-add">
            <div class="row">
                <h2>AJOUTS RECENTS</h2>
            </div>
            <div class="row">
                <table class="col-xs-12">
                    <tr>
                        <th>Titre du livre</th>
                        <th>Auteurs</th>
                        <?php if (!empty($w_user)): ?> <th>Ajout</th>  <?php endif ?>
                    </tr>
                    <?php foreach($books as $book):?>
                    <tr>
                        <td><?php echo $book['title'] ?></td>
                        <td><?php echo $book['author'] ?></td>
                        <?php if (!empty($w_user)): ?>
                            <td>
                                <button type="submit" class="btn-add"><img class="p0" src="<?= $this->assetUrl('img/logoAdd.svg') ?>" alt=""></button>
                            </td>
                        <?php endif ?>
                    </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>
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
                    <a href=""><img class="logoBookkeeper" src="<?= $this->assetUrl('img/LogoBlancOr1.svg')?>" alt="LogoBookkeeper"></a>
                    <a href=""><img class="logoWebForce pull-right" src="<?= $this->assetUrl('img/logoWebforce.png')?>" alt="LogoWebforce"></a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h4>&copy; Bookkeeper</h4>
                </div>
            </div>
        </div>
</div>

</body>
</html>