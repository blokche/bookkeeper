<?php $this->layout('layout', ['title' => 'Ajouter une citation']) ?>

<?php $this->start('main_content') ?>

    <ol class="breadcrumb">
        <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
        <li><a href="<?php echo $this->url('profile.home') ?>">Mon profil</a></li>
        <li><a href="<?php echo $this->url('profile.quote') ?>">Mes citations / extraits</a></li>
        <li class="active">Ajouter un une citation/extrait</li>
    </ol>

    <form action="<?php $this->url('profile.quote.add') ?>" method="POST" >
        
        <div class="form-group">
            <label for="content">Citation / extrait :</label>
            <textarea  id="content" name="content" class="form-control" type="text" required></textarea>
        </div>

        <?php if (count($books) > 0) : ?>
        <div class="form-group">
            <label for="linkedbook">Associer un livre à l'extrait / la citation</label>
            <select name="linkedbook" id="linkedbook" class="form-control">
                <option value="0"></option>
                <?php foreach ($books as $book) : ?>
                    <option value="<?= $book['id'] ?>"><?= $book['title'] ?> - <?= $book['author'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="author">Auteur :</label>
            <input id="author" name="author" class="form-control" type="text" placeholder="Auteur">
        </div>

        <input type="submit" name="addQuote" class="btn btn-default" value="Ajouter une citation" />
    </form>



<?php $this->stop('main_content') ?>
<?php $this->start('js') ?>
    <script src="<?php echo $this->assetUrl('scripts/quoteForm.js'); ?>"></script>
<?php $this->stop('js'); ?>