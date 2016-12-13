<?php $this->layout('admin', ['title' => 'Liste des livres']);

$this->start('main_content');?>
<h1><i class="fa fa-book" aria-hidden="true"></i> Liste des livres</h1>
<?php if (count($books) > 0) : ?>
    <table class="table table-responsive table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php foreach($books as $book) : ?>
            <tr>
                <td><?php echo $book['id']; ?></td>
                <td><?php echo $book['title']; ?></td>
                <td><?php echo $book['author']; ?></td>
                <td>
                    <a class="btn btn-default" href="<?php echo $this->url('admin.book.view', ['id' => $book['id']]) ?>">Consulter</a>
                    <a class="btn btn-primary" href="<?php echo $this->url('admin.book.edit', ['id' => $book['id']]) ?>">Éditer</a></li>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <p>Aucun utilisateur.</p>
<?php endif; ?>
<?php $this->stop('main_content') ?>
