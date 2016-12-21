<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= $this->url('home') ?>"><img src="<?= $this->assetUrl('img/LogoBlancOr1.svg') ?>" alt=""></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown	<?php if ($w_current_route=="public.book" || $w_current_route=="public.search" || $w_current_route=="profile.book.add" ) { echo "active"; } ?>   ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Livres<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li  <?php if ($w_current_route=="public.book") { echo "class='active'"; } ?>  >
                            <a href="<?= $this->url('public.book',['page' => 1]) ?>">Liste des livres</a>
                        </li>
                        <li <?php if ($w_current_route=="public.search") { echo "class='active'"; } ?>  >
                            <a href="<?= $this->url('public.search') ?>">Recherche</a>
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Liste de lecture<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li <?php if ($w_current_route=="profile.bookread") { echo "class='active'"; } ?> >
                            <a href="<?= $this->url('profile.bookread',['page' => 1]) ?>">Livres lus</a>
                        </li>
                        <li <?php if ($w_current_route=="profile.bookunread") { echo "class='active'"; } ?>  >
                            <a href="<?= $this->url('profile.bookunread',['page' => 1]) ?>">Livres non lus</a>
                        </li>
                    </ul>
                </li>
                <li  <?php if ($w_current_route=="profile.quote") { echo "class='active'"; } ?>  >
                    <a href="<?= $this->url('profile.quote') ?>">Citations</a>
                </li>

                <?php endif; ?>
                <li <?php if ($w_current_route=="public.libraries") { echo "class='active'"; } ?>  >
                    <a href="<?= $this->url('public.libraries') ?>">Librairies</a>
                </li>
            </ul>
                <?php if(empty($w_user)) :?>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="login">
                            <a href="#" type="button" data-toggle="modal" data-target="#myModal">
                                Se connecter
                            </a>
                        </li>
                    </ul>

                <?php else : ?>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href=" <?= $this->url('profile.home') ?> ">Profil</a>
                        </li>
                        <?php if($w_user['role']=="admin") : ?>
                            <li>
                                <a href="<?= $this->url('admin.home') ?>">Admin</a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <a href="<?= $this->url('auth.logout') ?>">Déconnexion</a>
                        </li>

                    </ul>
                <?php endif; ?>

        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Se Connecter</h4>
            </div>
            <form class="login navbar-form" action="<?= $this->url('auth.login') ?>" method="POST">
                <div class="modal-body">
                        <div class="form-group">
                            <input id="email" name="email" type="text" class="form-nav" placeholder="Votre Pseudo">
                            <input id="password" name="password" type="password" class="form-nav" placeholder="Votre Password">
                        </div>
                        <div class="forgetpassword">
                            <a href="<?= $this->url	('auth.forgetpassword') ?>">Mot de passe oublié ?</a>
                        </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button name="login" class="btn btn-default">Se connecter</button>
                    </div>
            </form>
        </div>
    </div>
</div>