<?php $this->layout('admin', ['title' => 'Book details']);

$this->start('main_content');?>
<header class="site-header">
    <h1><small>Détails et informations</small><br /><?php echo $book['title'] ?></h1>
</header>
<div class="row">
    <?php if($book['cover'] !== NULL) : ; ?>
        <div class="col-sm-12 col-md-6">
            <img src="<?php echo $this->assetUrl("/../upload/cover/".$book['cover'])?>" alt="<?php echo $book['title'];?>" />
        </div>
    <?php endif; ?>
    <div class="col-sm-12 col-md-6">
        <table class="table table-responsive table-striped">
            <tr>
                <th>Titre</th>
                <td><?php echo $book['title'] ?></td>
            </tr>
            <tr>
                <th>Auteur</th>
                <td><?php echo $book['author'] ?></td>
            </tr>
            <tr>
                <th>Statut</th>
                <td><?php echo $book['status'] == 1 ? "Actif" : "Inactif" ?></td>
            </tr>
            <?php if(count($categories) > 0) : ?>
                <?php $categoriesText = "";

                for ($i = 0, $total = count($categories); $i < $total ; $i++) {
                    if ($i !== ($total - 1)) {
                        $categoriesText .= $categories[$i]['label'].", ";
                    } else {
                        $categoriesText .= $categories[$i]['label'];
                    }
                };
                ?>
                <tr>
                    <th>Catégories</th>
                    <td><?php echo $categoriesText ?></td>
                </tr>
            <?php endif; ?>
        </table>
        <a class="btn btn-primary" href="<?php echo $this->url('admin.book.edit', ['id' => $book['id']]); ?>">Editer le livre</a>
    </div>
</div>
<?php $this->stop('main_content') ?>