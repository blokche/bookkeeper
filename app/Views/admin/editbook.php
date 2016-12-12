<?php $this->layout('admin', ['title' => 'Book edit']);

$this->start('main_content');?>
    <h1>Edition du livre</h1>
    <form enctype="multipart/form-data" method="POST" action="<?php echo $this->url('admin.book.edit', ['id' => $book['id']]) ?>">
        <?php if ($book['cover'] !== NULL) : ?>
            <img src="<?php echo $this->assetUrl("/../upload/cover/".$book['cover'])?>" alt="<?php echo $book['title'];?>" />
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
            <label for="categories">Catégories</label>
            <select name="categories[]" id="categories" multiple>
                <?php foreach($categories as $category) : ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo in_array($category['id'], $categoriesBook)  ? 'selected' : null; ?>><?php echo $category['label']; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div>
            <label for="active">Actif ?</label>
            <input id="active" type="checkbox" name="active" value="active" <?php echo ($book['status'] == "1") ? "checked" : null ?>>
        </div>
        <input type="submit" value="Modifier" name="edit">
    </form>
    <form method="POST" action="<?php echo $this->url('admin.book.delete', ['id' => $book['id']]); ?>">
        <input name="deletebook" type="submit" value="Supprimer">
    </form>
<?php $this->stop('main_content') ?>