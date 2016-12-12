<?php $this->layout('admin', ['title' => 'Ajouter un livre']); ?>
<?php $this->start('main_content') ?>
    <h1>Ajouter un livre</h1>
    <form name="addbook" enctype="multipart/form-data" method="POST" action="<?php echo $this->url('admin.book.add') ?>">
        <div>
            <label for="title">Titre</label>
            <input type="text" name="title" id="title" placeholder="Titre" required>
        </div>
        <div>
            <label for="author">Auteur</label>
            <input type="text" name="author" id="author" placeholder="Auteur" required>
        </div>
        <div>
            <label for="cover">Couverture</label>
            <input type="file" name="cover" id="cover">
        </div>
        <div>
            <label for="categories">
                <select name="categories[]" id="categories" multiple>
                <?php foreach($categories as $category) : ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['label'] ?></option>
                <?php endforeach; ?>
                </select>
            </label>
        </div>
        <input type="submit" value="Ajouter" name="addbook">
    </form>
<?php $this->stop('main_content') ?>