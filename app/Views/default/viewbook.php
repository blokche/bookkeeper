<?php

$this->layout('layout', ['title' => $book['title']]) ;

$this->start('main_content');

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
           class="btn btn-default"><i class="fa fa-times" aria-hidden="true"></i></a>

        <?php

        if ($ReadingList['read_status'] == 1) :
            ?>

            <a href="  <?php echo $this->url('public.view', ['id' => $ReadingList['book_id'], 'status' => 0]); ?>  "
               class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

            <?php
        else :
            ?>
            <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $ReadingList['book_id'], 'status' => 1]) ?>  "
               class="btn btn-default"><i class="fa fa-check" aria-hidden="true"></i></a>
            <?php
        endif;
    else : ?>

        <a href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 0]); ?>  "
           class="btn btn-default"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

        <a href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 1]); ?>  "
           class="btn btn-default"><i class="fa fa-check" aria-hidden="true"></i></a>

        <?php
    endif;
endif;
$this->stop('main_content')

?>
