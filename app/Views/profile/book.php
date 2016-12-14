<?php $this->layout('layout', ['title' => 'Livres de '.$w_user['username']]) ?>

<?php $this->start('main_content') ?>

    <p>Liste des livres lu:</p>
    <ul>
        <?php
        foreach ($bookRead as $book){
            $cover = (!empty($book['cover'])) ? $book['cover'] : $this->assetUrl('../upload/cover/default.jpg'); ?>
            <li><img src="<?php echo $cover ?>" alt="cover de <?php echo $book['title'] ?>"> <?php echo $book['title'] ?> <?php echo $book['author'] ?></li>
        <?php } ?>
    </ul>

    <p>Liste des livres à lire:</p>
    <ul>
        <?php
        foreach ($bookNoRead as $book){
            $cover = (!empty($book['cover'])) ? $book['cover'] : $this->assetUrl('../upload/cover/default.jpg'); ?>
            <li><img src="<?php echo $cover ?>" alt="cover de <?php echo $book['title'] ?>"> <?php echo $book['title'] ?> <?php echo $book['author'] ?></li>
        <?php } ?>
    </ul>


<?php $this->stop('main_content') ?>