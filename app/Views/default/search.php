<?php
$this->layout('layout', ['title' => 'Recherche']);
$this->start('main_content');
?>

    <form action="<?php echo $this->url('public.search'); ?>" method="POST">
        <label for="search">Effectuer une recherche</label>
        <input id="search" type="search" name="q" id="q" placeholder="Rechercher">
        <input type="submit" name="search" value="Rechercher">
    </form>

    <?php if (isset($results)) : ?>
        <h2>Résultats pour &laquo; <?php echo $searchTerm; ?> &raquo;</h2>
        <ul>
        <?php foreach ($results as $result) : ?>
            <li><a href="<?php echo $this->url('public.view', ['id' => $result['id']]); ?>"><?php echo $result['title'] ?> <small>(<?php echo $result['author']; ?>)</small></a></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

<?php $this->stop('main_content') ?>