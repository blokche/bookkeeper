<?php $this->layout('layout', ['title' => 'Livres de '.$w_user['username']]) ?>

<?php $this->start('main_content'); ?>

    <div class="container">

        <div class="titre-liste row">
            <h2>Liste des livres à lire:</h2>
        </div>

        <div class="row">
            <?php
            foreach ($bookNoRead as $book){ ?>
                <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                    <div class="cover">
                        <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.png';?>
                        <img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">
                    </div>
                    <a href="    <?php echo $this->url('public.view', ['id' => $book['book_id']]) ?>    ">
                        <h3><?php echo $book['title'] ?></h3>
                        <h4><?php echo $book['author'] ?></h4>
                    </a>

                    <a href="  <?php echo $this->url('profile.book.delete', ['id' => $book['book_id']]) ?>  " class="btn btn-default"  >Enlever de ma liste de lecture</a>
                    <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'],'status' => 0]) ?>  " class="btn btn-default"  >Marquer comme non lue</a>

                </div>
            <?php } ?>
        </div>
    </div>


<?php $this->stop('main_content') ?>