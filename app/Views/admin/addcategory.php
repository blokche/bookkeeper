<?php $this->layout('admin', ['title' => 'Ajouter une catégorie']); ?>
<?php $this->start('main_content') ?>
    <header class="site-header">
        <h1 class="text-center">Ajouter une catégorie</h1>
    </header>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-md-push-3">
            <form method="POST" action="<?php echo $this->url('category.add') ?>">
                <div class="form-group">
                    <label for="label">Label</label>
                    <input type="text" class="form-control" name="label" id="label" placeholder="Label" required>
                </div>
                <input class="btn btn-success btn-block" type="submit" value="Ajouter la catégorie" name="addcategories">
            </form>
        </div>
    </div>
<?php $this->stop('main_content') ?>