<?php $this->layout('admin', ['title' => 'Liste des livres']);

$this->start('main_content');?>
<h1><i class="fa fa-book" aria-hidden="true"></i> Liste des livres</h1>
<?php if (count($books) > 0) : ?>
    <div id="books">
        <div class="form-group">
            <input style="margin-bottom:1em;" class="search form-control" placeholder="Recherche..." />
            <button class="sort btn btn-default" data-sort="author">Trier par auteur</button>
            <button class="sort btn btn-default" data-sort="title">Trier par titre</button>
        </div>
        <table class="table table-responsive table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="list">
            <?php foreach($books as $book) : ?>
                <tr>
                    <td><?php echo $book['id']; ?></td>
                    <td class="title"><?php echo $book['title']; ?></td>
                    <td class="author"><?php echo $book['author']; ?></td>
                    <td>
                        <a class="btn btn-default" href="<?php echo $this->url('admin.book.view', ['id' => $book['id']]) ?>">Consulter</a>
                        <a class="btn btn-primary" href="<?php echo $this->url('admin.book.edit', ['id' => $book['id']]) ?>">Éditer</a></li>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <p>Aucun utilisateur.</p>
<?php endif; ?>
<?php $this->stop('main_content') ?>

<?php $this->start('js');?>
<script src="<?php echo $this->assetUrl('vendor/list.js') ?>"></script>
<script>

    var options = {
        valueNames: [ 'author', 'title' ]
    };

    var booksList = new List('books', options);
</script>
<?php $this->stop('js') ?>
