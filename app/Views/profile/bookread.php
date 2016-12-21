<?php $this->layout('layout', ['title' => 'Mes livres lu']) ?>



<?php $this->start('main_content'); ?>
        <ol class="breadcrumb">
            <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
            <li><a href="<?php echo $this->url('profile.home') ?>">Mon profil</a></li>
            <li class="active">Mes livres lus</li>
        </ol>


        <div class="titre-liste row">
            <h2>Liste des livres lus:</h2>
        </div>

        <div class="row booklist">
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

                    <a href="  <?php echo $this->url('profile.book.delete', ['id' => $book['book_id']]) ?>  " class="btn btn-warning btn-block">Retirer de ma liste</a>
                    <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'],'status' => 0]) ?>  " class="btn btn-info btn-block" >Marquer non lu</a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <?php

            if ($nbPages==0)
                $page=0;

            $previousPage = $page -1;
            $nextPage = $page +1;
            ?>
            <div class="pagination pager">
                <?php if ($page > 1) : ?>
                    <li><a href="<?php echo $this->url('profile.bookunread', ['page' => $previousPage]) ?>">Résultats précédents</a></li>
                <?php endif; ?>
                <?php if ($page < $nbPages) : ?>
                    <li><a href="<?php echo $this->url('profile.bookunread', ['page' => $nextPage]) ?>">Résultats suivants</a></li>
                <?php endif; ?>
                <?php echo "<p>Page : ". $page."/".$nbPages."</p>"; ?>
            </div>
        </div>

<?php $this->stop('main_content') ?>
