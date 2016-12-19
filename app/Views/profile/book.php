<?php $this->layout('layout', ['title' => 'Livres de '.$w_user['username']]) ?>

<?php $this->start('main_content'); ?>

    <div class="container">

        <ol class="breadcrumb">
            <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
            <li><a href="<?php echo $this->url('profile.home') ?>">Mon profil</a></li>
            <li class="active">Liste de lecture</li>
        </ol>


        <div class="titre-liste row">
            <h2>Liste des livres lus:</h2>
        </div>

        <div class="row">
            <?php
            foreach ($bookRead as $book): ?>
                <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                    <a href="    <?php echo $this->url('public.view', ['id' => $book['book_id']]) ?>    ">
                        <div class="cover">
                            <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.png';?>
                            <img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">
                        </div>

                        <h3><?php echo $book['title'] ?></h3>
                        <h4><?php echo $book['author'] ?></h4>
                    </a>

                    <a href="  <?php echo $this->url('profile.book.delete', ['id' => $book['book_id']]) ?>  " class="btn btn-default"  >Enlever de ma liste de lecture</a>
                    <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'],'status' => 0]) ?>  " class="btn btn-default"  >Marquer comme non lue</a>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="titre-liste row">
            <h2>Liste des livres à lire:</h2>
        </div>

        <div class="row">
            <?php
            foreach ($bookNoRead as $book) : ?>
                <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                    <a href="    <?php echo $this->url('public.view', ['id' => $book['book_id']]) ?>    ">
                        <div class="cover">
                            <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.png';?>
                            <img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">
                        </div>
                        <h3><?php echo $book['title'] ?></h3>
                        <h4><?php echo $book['author'] ?></h4>
                    </a>

                    <a href="  <?php echo $this->url('profile.book.delete', ['id' => $book['book_id']]) ?>  " class="btn btn-default"  >Enlever de ma liste de lecture</a>
                    <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'],'status' => 1]) ?>  " class="btn btn-default"  >Marquer comme lu</a>
                </div>
            <?php endforeach; ?>
        </div>

<?php $this->stop('main_content') ?>