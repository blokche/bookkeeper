<?php
$this->layout('layout', ['title' => 'Recherche']);
$this->start('main_content');
?>
<div class="container-fluid background-book">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1>Rechercher un livre</h1>
                <p>Vous recherchez un livre ou les ouvrages d'un auteur en particulier ?<br />
                    Effectuez votre recherche grâce au formulaire ci-dessous.</p>
                <form class="form" action="<?php echo $this->url('public.search'); ?>" method="POST">
                    <div class="form-group">
                        <label for="search">Effectuer une recherche</label>
                        <input id="search" type="search" name="q" id="q" class="form-control" placeholder="Rechercher">
                    </div>
                    <input type="submit" class="btn btn-default" name="search" value="Rechercher">
                </form>
            </div>
        </div>

        <?php if (isset($results)) : ?>
        <div class="row">
            <div class="col-sm-12">
                <h2>Résultats de recherche pour &laquo; <?php echo $searchTerm; ?> &raquo;</h2>
            </div>
            <div class="col-sm-12">
                <?php if (!empty($results)) : ?>
              <ul>
                <?php foreach ($results as $result) : ?>
                    <li>
                        <a href="<?php echo $this->url('public.view', ['id' => $result['id']]); ?>">
                            <?php echo $result['title'] ?>
                            <small>(<?php echo $result['author']; ?>)</small>
                        </a>
                    </li>
                <?php endforeach; ?>
                <?php else : ?>
                    <p>Aucun résultat pour &laquo; <?php echo $searchTerm; ?> &raquo;.</p>
                    <?php if ($w_user): ?>
                    <p>Pourquoi ne pas nous faire <a href="<?php echo $this->url('profile.book.add'); ?>">une proposition de livre</a> ?</p>
                    <?php endif ?>
                <?php endif; ?>
                </ul>
            </div>
        </div>
</div>
<?php $this->stop('main_content') ?>