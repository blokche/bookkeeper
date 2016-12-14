<?php $this->layout('admin', ['title' => 'Ajouter un livre']); ?>
<?php $this->start('main_content') ?>
    <header class="site-header">
        <h1 class="text-center">Ajouter un livre</h1>
    </header>
    <div class="row">
        <div class="col-sm-12 col-md-6 col-md-push-3">
            <form class="form" name="addbook" enctype="multipart/form-data" method="POST" action="<?php echo $this->url('admin.book.add') ?>">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="Titre" required>
                </div>
                <div class="form-group">
                    <label for="author">Auteur</label>
                    <input class="form-control" type="text" name="author" id="author" placeholder="Auteur" required>
                </div>
                <div class="form-group">
                    <label for="cover">Couverture</label>
                    <input type="file" name="cover" id="cover">
                </div>
                <div class="form-group">
                    <label for="categories">Catégories</label>
                    <select size="5" name="categories[]" id="categories" class="form-control" multiple>
                        <?php foreach($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['label'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input class="btn btn-success" type="submit" value="Ajouter" name="addbook">
            </form>
        </div>
    </div>
<?php $this->stop('main_content') ?>