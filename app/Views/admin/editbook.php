<?php $this->layout('admin', ['title' => 'Book edit']);

$this->start('main_content');?>
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="<?php echo $this->url('admin.book.delete', ['id' => $book['id']]); ?>">
                <input class="btn btn-danger btn-sm" name="deletebook" type="submit" value="Supprimer &laquo; <?php echo $book['title']; ?> &raquo;">
            </form>
            <hr>
        </div>
    </div>
    <header class="site-header">
        <h1><small>Édition du livre</small><br /><?php echo $book['title']; ?></h1>
    </header>
    <div class="row">
    <?php if ($book['cover'] !== NULL) : ?>
        <div class="col-sm-12 col-md-6">
            <img class="thumbnail" src="<?php echo $this->assetUrl("/../upload/cover/".$book['cover'])?>" alt="<?php echo $book['title'];?>" />
        </div>
    <?php endif; ?>
        <div class="col-sm-12 col-md-6">
            <form class="form" enctype="multipart/form-data" method="POST" action="<?php echo $this->url('admin.book.edit', ['id' => $book['id']]) ?>">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="Titre" value="<?php echo $book['title'] ?>">
                </div>
                <div class="form-group">
                    <label for="author">Auteur</label>
                    <input class="form-control" type="text" name="author" id="author" placeholder="Titre" value="<?php echo $book['author'] ?>">
                </div>
                <div class="form-group">
                    <label for="cover"><?php echo ($book['cover'] !== NULL) ? "Proposer une autre couverture" : "Ajouter une couverture" ?></label>
                    <input class="form-control" type="file" name="cover" id="cover">
                </div>
                <div>
                    <label for="categories">Catégories</label>
                    <select size="5" class="form-control" name="categories[]" id="categories" multiple>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo in_array($category['id'], $categoriesBook)  ? 'selected' : null; ?>><?php echo $category['label']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="active">Actif ?</label>
                    <input id="active" type="checkbox" name="active" value="active" <?php echo ($book['status'] == "1") ? "checked" : null ?>>
                </div>
                <a href="<?php echo $this->url('admin.book.view', ['id' => $book['id']]); ?>" class="btn btn-default">Retour à la fiche</a>
                <input class="btn btn-success" type="submit" value="Modifier" name="edit">
            </form>
        </div>
    </div>

<?php $this->stop('main_content') ?>