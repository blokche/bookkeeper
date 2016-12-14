<?php $this->layout('admin', ['title' => 'Éditer une catégorie']); ?>
<?php $this->start('main_content') ?>
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="<?php echo $this->url('category.delete', ['id' => $category['id']]) ?>">
                <input class="btn btn-danger btn-sm" type="submit" value="Supprimer la catégorie &laquo; <?php echo $category['label'] ?> &raquo;" name="deletecategory">
            </form>
        </div>
    </div>
    <hr>
    <header class="site-header">
        <h1 class="text-center">Éditer une catégorie</h1>
    </header>
    <div class="col-sm-12 col-md-6 col-md-push-3">
        <form method="POST" action="<?php echo $this->url('category.edit', ['id' => $category['id']]) ?>">
            <div class="form-group">
                <label for="label">Label</label>
                <input type="text" class="form-control" name="label" value="<?php echo $category['label']; ?>" id="label" placeholder="Label" required>
            </div>
            <input type="submit" class="btn btn-success btn-block" value="Éditer la catégorie" name="editcategory">
        </form>
    </div>
<?php $this->stop('main_content') ?>