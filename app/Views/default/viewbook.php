<?php

$this->layout('layout', ['title' => $book['title']]) ;

$this->start('main_content'); ?>


<ol class="breadcrumb">
    <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
    <li><a href="<?php echo $this->url('public.book',['page'=> 1]); ?>">Liste de livres</a></li>
    <li class="active">  <?php echo $book['title'] ?>   </li>
</ol>


<?php
    $cover = (!empty($book['cover'])) ? $book['cover'] : $this->assetUrl('../upload/cover/default.png'); ?>

    <img src="<?php echo $this->assetUrl('/../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">

    <h2><?php echo $book['title'] ?></h2>
    <h3><?php echo $book['author'] ?></h3>



<?php

if ($w_user) :

    if ($ReadingList) : ?>
        <?php if ($ReadingList['read_status'] == 1) : ?>
            <p class="label label-success">Lu</p>
        <?php else: ?>
            <p class="label label-danger">Non lu</p>
        <?php endif ?>

        <p><a href=" <?php echo $this->url('profile.book.delete', ['id' => $ReadingList['book_id']]) ?>  " class="btn btn-warning">Retirer de ma liste</a></p>

        <?php

        if ($ReadingList['read_status'] == 1) : ?>
              
            <p><a  href="  <?php echo $this->url('profile.book.toggleread', ['id' => $ReadingList['book_id'], 'status' => 0]); ?>  " class="btn btn-info" >Marquer non lu</a></p>

            <?php
        else : ?>
            <p><a  href=" <?php echo $this->url('profile.book.toggleread', ['id' => $ReadingList['book_id'], 'status' => 1]) ?> " class="btn btn-success" >Marquer lu</a></p>
            <?php
        endif;
    else : ?>

        <p><a  href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 0]); ?> "  class="btn btn-info" >Ajouter comme non lu</a></p>
        <p><a  href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 1]); ?>  " class="btn btn-success">Ajouter comme lu</a></p>
        <?php
    endif;
endif;
$this->stop('main_content')

?>
