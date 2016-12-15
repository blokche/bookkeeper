<?php $this->layout('layout', ['title' => 'Modifier une citation']) ?>

<?php $this->start('main_content') ?>

    <form action="<?php $this->url('profile.quote.edit') ?>" method="POST" >
        <div class=" form-group">
            <label for="content">Modifier le contenu :</label>
            <textarea id="content" name="content" class="form-control" type="text"><?= $quote['content'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="linkedbook">Associer l'extrait / la citation à un livre</label>
            <select name="linkedbook" id="linkedbook">
                <option value="0"></option>
                <?php foreach ($books as $book) : ?>
                    <option value="<?= $book['id'] ?>"<?php echo ($quote['book_id'] == $book['id']) ? "selected" : null; ?>><?= $book['title'] ?> - <?php echo $book['author']?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class=" form-group">
            <label for="author">Modifier l'auteur :</label>
            <input value="<?php echo (isset($quote['book_id']) && $quote['book_id'] > 0) ? '' : $quote['author']; ?>" id="author" name="author" class="form-control" type="text">
        </div>
        <input type="submit" name="editQuote" class="btn btn-default" value="Modifier la citation" />
    </form>

    <form method="POST" action="<?php echo $this->url('profile.quote.delete', ['id' => $quote['id']]); ?>">
        <input type="submit" name="deleteQuote" value="Supprimer">
    </form>

<?php $this->stop('main_content') ?>
<?php $this->start('js') ?>
    <script src="<?php echo $this->assetUrl('scripts/quoteForm.js'); ?>"></script>
<?php $this->stop('js') ?>
