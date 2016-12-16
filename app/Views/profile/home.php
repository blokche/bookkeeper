<?php $this->layout('layout', ['title' => 'Profile de '.$w_user['username']]) ?>

<?php $this->start('main_content') ?>

    <div class="container">
        <div class="row profil">
            <div class=" col-xs-6 col-md-2">
                <img src="<?php echo $this->assetUrl('../upload/avatar')."/".$avatar ?>" alt="avatar">
            </div>
            <div class=" col-xs-12 col-md-6">
                <p><span class="gras">Pseudo :</span> <?php echo $w_user['username'] ?></p>
                <p><span class="gras">Email :</span> <?php echo $w_user['email'] ?></p>
                <p><span class="gras">Compte créé le :</span> <?php echo $w_user['created_at'] ?></p>
                <a href="<?php echo $this->url('profile.edit') ?>">Modifier son profil</a>
            </div>
        </div>

        <div class="titre-liste row">
            <h2>Liste des livres lus:</h2>
        </div>

        <div class="row">
            <?php
            foreach ($bookRead as $book) : ?>
                <a href="<?php echo $this->url('public.view', ['id' => $book['book_id']]); ?>">
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
        </div>

        <div class="titre-liste row">
            <h2>Liste des livres à lire:</h2>
        </div>

        <div class="row">
            <?php
            foreach ($bookNoRead as $book) : ?>
                <a href="<?php echo $this->url('public.view', ['id' => $book['book_id']]); ?>">
                    <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                        <div class="cover">
                            <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg';?>
                            <img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">
                        </div>
                        <h3><?php echo $book['title'] ?></h3>
                        <h4><?php echo $book['author'] ?></h4>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>


<?php $this->stop('main_content') ?>
