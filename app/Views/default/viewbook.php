<?php

$this->layout('layout', ['title' => $book['title']]) ;

$this->start('main_content');

//var_dump($book);

//var_dump($ReadingList);


$cover = (!empty($book['cover'])) ? $book['cover'] : $this->assetUrl('../upload/cover/default.png'); ?>

    <img src="<?php echo $cover ?>" alt="cover de <?php echo $book['title'] ?>">
    <p>  <?php echo $book['title'] ?>, par <?php echo $book['author'] ?>    </p>


<?php

if ($w_user) {

    if ($ReadingList) {
        ?>
        <a href="  <?php echo $this->url('profile.book.delete', ['id' => $ReadingList['book_id']]) ?>  "
           class="btn btn-default">Enlever de ma liste de lecture</a>

        <?php

        if ($ReadingList['read_status'] == 1) {
            ?>
            <a href="  <?php echo $this->url('public.view', ['id' => $ReadingList['book_id'], 'status' => 0]); ?>  "
               class="btn btn-default">Marquer comme non lue</a>

            <?php

        } else {
            ?>
            <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $ReadingList['book_id'], 'status' => 1]) ?>  "
               class="btn btn-default">Marquer comme lue</a>
            <?php
        }
    } else { ?>

        <a href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 0]); ?>  "
           class="btn btn-default">Ajouter ce livre dans ma liste de lecture en tant que livre non lu </a>

        <a href="  <?php echo $this->url('profile.readinglist.add', ['id' => $book['id'], 'status' => 1]); ?>  "
           class="btn btn-default"> Ajouter ce livre dans ma liste de lecture en tant que livre lu </a>

        <?php

    }
}
$this->stop('main_content')

?>
