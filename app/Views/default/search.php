<?php
$this->layout('layout', ['title' => 'Recherche']);
$this->start('main_content');
?>
<div class="container-fluid background-book">
    <div class="container">
        <div class="row">
            <form action="<?php echo $this->url('public.search'); ?>" method="POST">
                <label for="search">Effectuer une recherche</label>
                <input id="search" type="search" name="q" id="q" placeholder="Rechercher">
                <input type="submit" name="search" value="Rechercher">
            </form>
        </div>
        <?php if (isset($results)) : ?>
        <div class="row">
            <h2>Résultats pour &laquo; <?php echo $searchTerm; ?> &raquo;</h2>
        </div>
        <div class="row">
                <ul>
                <?php foreach ($results as $result) : ?>
                    <li>
                        <a href="<?php echo $this->url('public.view', ['id' => $result['id']]); ?>">
                            <?php echo $result['title'] ?>
                            <small>(<?php echo $result['author']; ?>)</small>
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php if ($w_user): ?>
                <p>Si vous ne trouvez pas le livre que vous recherchez, <a
                    href="   <?php echo $this->url('profile.book.add'); ?>   "> vous pouvez l'ajouter ici </a></p>
            <?php endif ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->stop('main_content') ?>