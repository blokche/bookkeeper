<?php $this->layout('layout', ['title' => 'Livres de '.$w_user['username']]) ?>

<?php $this->start('main_content'); ?>


    <p>Liste des livres lu:</p>

    <ul>
        <?php
        foreach ($bookRead as $book){
            $cover = (!empty($book['cover'])) ? $book['cover'] : $this->assetUrl('../upload/cover/default.png'); ?>
            <li>

                <img src="<?php echo $cover ?>" alt="cover de <?php echo $book['title'] ?>">    
                <a href="    <?php echo $this->url('public.view', ['id' => $book['book_id']]) ?>    ">     <?php echo $book['title'] ?>, par <?php echo $book['author'] ?>    </a>

                <a href="  <?php echo $this->url('profile.book.delete', ['id' => $book['book_id']]) ?>  " class="btn btn-default"  >Enlever de ma liste de lecture</a>
                <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'],'status' => 0]) ?>  " class="btn btn-default"  >Marquer comme non lu</a>


            </li>
        <?php } ?>
    </ul>

    <p>Liste des livres à lire:</p>

    <ul>
        <?php
        foreach ($bookNoRead as $book){
            $cover = (!empty($book['cover'])) ? $book['cover'] : $this->assetUrl('../upload/cover/default.png'); ?>
            <li>
                <img src="<?php echo $cover ?>" alt="cover de <?php echo $book['title'] ?>">   
                <a href="   <?php echo $this->url('public.view', ['id' => $book['book_id']]) ?>    ">    <?php echo $book['title'] ?>, par <?php echo $book['author'] ?>   </a>

                <a href="  <?php echo $this->url('profile.book.delete', ['id' => $book['book_id']]) ?>  " class="btn btn-default"  >Enlever de ma liste de lecture         </a>
                <a href="  <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'],'status' => 1]) ?>  " class="btn btn-default"  >Marquer comme lue    </a>

            </li>
        <?php } ?>
    </ul>


<?php $this->stop('main_content') ?>