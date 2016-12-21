<?php

$this->layout('layout', ['title' => $book['title']]) ;

$this->start('main_content'); ?>


<ol class="breadcrumb">
    <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
    <li><a href="<?php echo $this->url('public.book',['page'=> 1]); ?>">Liste de livres</a></li>
    <li class="active">  <?php echo $book['title'] ?>   </li>
</ol>

<div class="book">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <?php $cover = (!empty($book['cover'])) ? $book['cover'] : $this->assetUrl('../upload/cover/default.png'); ?>
            <img src="<?php echo $this->assetUrl('/../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">
        </div>
        <div class="col-xs-12 col-md-6">
    <h2><?php echo $book['title'] ?></h2>
    <h3><?php echo $book['author'] ?></h3>



    <?php

    if ($w_user) :

        if ($ReadingList) : ?>
            <?php if ($ReadingList['read_status'] == 1) : ?>
                <p class="label label-success label-perso">Lu</p>
            <?php else: ?>
                <p class="label label-danger label-perso">Non lu</p>
            <?php endif ?>

            <p><a href=" <?php echo $this->url('profile.book.delete', ['id' => $ReadingList['book_id']]) ?>  " class="btn btn-warning label-perso">Retirer de ma liste</a></p>

            <?php

            if ($ReadingList['read_status'] == 1) : ?>

                <p><a  href="  <?php echo $this->url('profile.book.toggleread', ['id' => $ReadingList['book_id'], 'status' => 0]); ?>  " class="btn btn-info label-perso" >Marquer non lu</a></p>

                <?php
            else : ?>
                <p><a  href=" <?php echo $this->url('profile.book.toggleread', ['id' => $ReadingList['book_id'], 'status' => 1]) ?> " class="btn btn-success label-perso" >Marquer lu</a></p>
                <?php
            endif;
        else : ?>

            <p><a  href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 0]); ?> "  class="btn btn-info label-perso" >Ajouter comme non lu</a></p>
            <p><a  href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 1]); ?>  " class="btn btn-success label-perso">Ajouter comme lu</a></p>
            <?php
        endif;
    endif;
    $this->stop('main_content')

    ?>
        </div
    </div>
</div>