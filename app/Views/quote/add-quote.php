<?php $this->layout('layout', ['title' => 'Ajouter une citation']) ?>

<?php $this->start('main_content') ?>

    <form action="<?php $this->url('profile.quote.add') ?>" method="POST" >
        
        <div class=" form-group">
            <label for="content">Contenu :</label>
            <textarea  id="content" name="content" class="form-control" type="text"></textarea>
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
            <label for="author">Auteur :</label>
            <input id="author" name="author" class="form-control" type="text">
        </div>


        <button name="addQuote" class="btn btn-default">Ajouter une citation</button>
    </form>


<?php $this->stop('main_content') ?>