<?php $this->layout('layout', ['title' => 'Profile de '.$w_user['username']]) ?>

<?php $this->start('main_content') ?>

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
            <li class="active">Mon profil</li>
        </ol>
        <div class="row profil">
            <div class=" col-xs-6 col-md-2">
                <img src="<?php echo $this->assetUrl('../upload/avatar')."/".$avatar ?>" alt="avatar">
            </div>
            <div class=" col-xs-12 col-md-6">
                <p><span class="gras">Pseudo :</span> <?php echo $w_user['username'] ?></p>
                <p><span class="gras">Email :</span> <?php echo $w_user['email'] ?></p>
                <?php $date = new DateTime($w_user['created_at']); ?>
                <p><span class="gras">Compte créé le :</span> <?php echo $date->format('d/m/Y, à h\hm'); ?></p>
                <? if (isset($w_user['updated_at'])): ?>
                    <p><span class="gras">Derniere modification effectuée le :</span> <?php echo $w_user['updated_at'] ?></p>
                <? endif ?>
                <a href="<?php echo $this->url('profile.edit') ?>">Modifier mon profil</a>
            </div>
        </div>
        <?php if(!empty($bookRead)) : ?>

        <div class="titre-liste row">
            <a href="<?php echo $this->url('profile.bookread', ['page' => 1]) ?>"><h2>Vos derniers livres lus :</h2></a>
        </div>
            
        <div class="row">
            <?php if (empty($booksRead)) : ?>
                <?php foreach ($bookRead as $book) : ?>
                <a href="<?php echo $this->url('public.view', [ 'id' => $book['book_id'] ]); ?>">
                    <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                        <div class="cover">
                            <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.png';?>
                            <img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">
                        </div>
                        <h3><?php echo $book['title'] ?></h3>
                        <h4><?php echo $book['author'] ?></h4>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else : ?>
            <p>Aucun livre dans votre liste de livres lus.</p>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if( !empty($bookUnRead) ) : ?>
        <div class="titre-liste row">
            <a href="<?php echo $this->url('profile.bookunread', ['page' => 1]) ?>"><h2>Livres que vous envisagez de lire :</h2></a>
        </div>

        <div class="row">
            <?php if (!empty($bookUnRead)) : ?>
            <?php foreach ($bookUnRead as $book) : ?>
                <a href="<?php echo $this->url('public.view', ['id' => $book['book_id']]); ?>">
                    <div class="vignette col-xs-6 col-sm-4 col-md-2">
                        <div class="cover">
                            <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg';?>
                            <img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">
                        </div>
                        <h3><?php echo $book['title'] ?></h3>
                        <h4><?php echo $book['author'] ?></h4>
                    </div>
            </a>
            <?php endforeach; ?>
            <?php else : ?>
                <p>Aucun livre dans votre liste de lectures futures...</p>
            <?php endif ; ?>
        </div>
        </div>
        <?php endif; ?>

<?php $this->stop('main_content') ?>
