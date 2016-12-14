<?php $this->layout('layout', ['title' => 'Liste de lecture']) ?>

<?php $this->start('main_content') ?>

    <pre>

<?php

if (isset($books)) {
    foreach ($books as $book) {

        echo $book['title'];

        echo "Statut du livre : ";

        if ($book['read_status'] == 1) {
            echo "Le livre est lu";
        } else {
            echo "Le livre n'est pas encore lue";
        }


        if ($book['status'] == 1) {
            ?>
            <a class="btn btn-default"
               href=" <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'], 'status' => 0]); ?> "
               role="button">Marquer comme non lue</a>

            <?php
        } else {
            ?>
            <a class="btn btn-default"
               href=" <?php echo $this->url('profile.book.toggleread', ['id' => $book['book_id'], 'status' => 1]); ?> "
               role="button">Marquer comme lue</a>
            <?php
        }

        ?>


    <a class="btn btn-default" href=" <?php echo $this->url('profile.book.delete', ['id' => $book['book_id']]); ?>"
       role="button">Supprimer de ma liste de lecture</a>


        <?php
    }

} else {
    echo "aucun livre dans la liste";
}

?>

</pre>

<?php $this->stop('main_content') ?>