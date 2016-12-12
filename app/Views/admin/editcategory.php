<?php $this->layout('admin', ['title' => 'Éditer une catégorie']); ?>
<?php $this->start('main_content') ?>
    <h1>Éditer une catégorie</h1>
    <form method="POST" action="<?php echo $this->url('category.edit', ['id' => $category['id']]) ?>">
        <div>
            <label for="label">Label</label>
            <input type="text" name="label" value="<?php echo $category['label']; ?>" id="label" placeholder="Label" required>
        </div>
        <input type="submit" value="Éditer la catégorie" name="editcategory">
    </form>
    <form method="POST" action="<?php echo $this->url('category.delete', ['id' => $category['id']]) ?>">
        <input type="submit" value="Supprimer" name="deletecategory">
    </form>
<?php $this->stop('main_content') ?>