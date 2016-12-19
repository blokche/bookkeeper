<?php
$this->layout('layout', ['title' => 'Recherche']);
$this->start('main_content');
?>
<div class="container-fluid background-book">
    <div class="container">
       <!-- <div class="row logo-search-bar">
            <img src="<?php /*echo $this->assetUrl('img/LogoBlancOr.svg')*/?>" alt="">
        </div>
        -->
        <div class="row searchBar">
            <form action="<?php echo $this->url('public.search'); ?>" method="POST">
                <div class="col-xs-12 col-md-9 p0">
                    <input class="main-search-bar" id="search"  type="search" name="q" id="q" placeholder="Rechercher">
                </div>
                <div class="col-xs-12 col-md-3 p0">
                    <button class="btn-search" type="submit" name="search"><img class="p0" src="<?= $this->assetUrl('img/logoLunettes.svg')?>" alt=""></button>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <?php if (isset($results)) : ?>
            <h2>Résultats pour &laquo; <?php echo $searchTerm; ?> &raquo;</h2>
        </div>

        <div class="row result-search">
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
            <?php endif; ?>
        </div>
    </div>
</div>

    <?php $this->stop('main_content') ?>