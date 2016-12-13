<?php $this->layout('layout', ['title' => 'Modifier une citation']) ?>

<?php $this->start('main_content') ?>

    <form action="<?php $this->url('profile.quote.edit') ?>" method="POST" >
        <div class=" form-group">
            <label for="content">Modifier le contenu :</label>
            <textarea id="content" name="content" class="form-control" type="text"><?= $quote['content'] ?></textarea>
        </div>


        <select name="book" id="book">
            <option value="-1">Pas de livre associé</option>
            <?php
            foreach ($books as $book)
            {?>

                <option value="<?= $book['id'] ?>"><?= $book['title'] ?></option>

                <?php
            }
            ?>
        </select>
        
        
        <div class=" form-group">
            <label for="author">Modifier l'auteur :</label>
            <input value="<?= $quote['author'] ?>" id="author" name="author" class="form-control" type="text">
        </div>
        <button name="editQuote" class="btn btn-default">Modifier la citation</button>
    </form>


<?php $this->stop('main_content') ?>