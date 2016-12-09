<?php $this->layout('admin', ['title' => 'Book edit']);

$this->start('main_content');?>
    <h1>Edition du livre</h1>
    <form enctype="multipart/form-data" method="POST" action="<?php $this->url('admin.book.edit', ['id' => $book['id']]) ?>">
        <?php if ($book['cover'] !== NULL) : ?>
            <img src="<?php echo $book['cover'] ?>" alt="<?php echo $book['title'] ?>">
        <?php endif; ?>
        <div>
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" placeholder="Titre" value="<?php echo $book['title'] ?>">
        </div>
        <div>
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" placeholder="Titre" value="<?php echo $book['author'] ?>">
        </div>
        <div>
            <label for="cover"><?php echo ($book['cover'] !== NULL) ? "Proposer une autre couverture" : "Ajouter une couverture" ?></label>
            <input type="file" name="cover" id="cover">
        </div>
        <div>
            <label for="active">Actif ?</label>
            <input id="active" type="checkbox" name="active" value="active" checked="<?php echo ($book['status'] == 1) ? 'checked' : "" ?>">
        </div>
        <input type="submit" value="Modifier" name="edit">
    </form>
<?php $this->stop('main_content') ?>