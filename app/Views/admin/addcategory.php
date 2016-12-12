<?php $this->layout('admin', ['title' => 'Ajouter une catégorie']); ?>
<?php $this->start('main_content') ?>
    <h1>Ajouter une catégorie</h1>
    <form method="POST" action="<?php echo $this->url('category.add') ?>">
        <div>
            <label for="label">Label</label>
            <input type="text" name="label" id="label" placeholder="Label" required>
        </div>
        <input type="submit" value="Ajouter la catégorie" name="addcategories">
    </form>
<?php $this->stop('main_content') ?>