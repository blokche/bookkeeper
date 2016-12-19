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
    <p>
        <?php echo $book['title'] ?>
        <?php if (!empty($book['author'])) :
            echo "<span>, par </span>"; echo $book['author'];
        endif;
        ?>
    </p>


<?php

if ($w_user) :

    if ($ReadingList) :
        ?>
        <a href="  <?php echo $this->url('profile.book.delete', ['id' => $ReadingList['book_id']]) ?>  "
           class="btn btn-default">Enlever de ma liste de lecture</a>

        <?php

        if ($ReadingList['read_status'] == 1) :
            ?>
            <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $ReadingList['book_id'], 'status' => 0]); ?>  "
               class="btn btn-default">Marquer comme non lu</a>

            <?php
        else :
            ?>
            <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $ReadingList['book_id'], 'status' => 1]) ?>  "
               class="btn btn-default">Marquer comme lu</a>
            <?php
        endif;
    else : ?>

        <a href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 0]); ?>  "
           class="btn btn-default">Ajouter ce livre dans ma liste de lecture en tant que livre non lu </a>

        <a href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 1]); ?>  "
           class="btn btn-default"> Ajouter ce livre dans ma liste de lecture en tant que livre lu </a>

        <?php
    endif;
endif;
$this->stop('main_content')

?>
