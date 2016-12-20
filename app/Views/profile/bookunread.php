<?php $this->layout('layout', ['title' => 'Mes livres à lire']) ?>

<?php $this->start('main_content'); ?>
    <ol class="breadcrumb">
        <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
        <li><a href="<?php echo $this->url('profile.home') ?>">Mon profil</a></li>
        <li class="active">Mes livres à lire</li>
    </ol>

    <div class="titre-liste row">
        <h2>Liste des livres à lire:</h2>
    </div>

    <div class="row">
        <?php
        foreach ($bookUnRead as $book) : ?>
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
                <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'],'status' => 1]) ?>  " class="btn btn-default"  >Marquer comme lue</a>

            </div>
        <?php endforeach; ?>
    </div>

    <div class="row">
        <?php
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