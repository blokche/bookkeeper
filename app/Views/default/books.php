<?php
    $this->layout('layout', ['title' => 'Liste des livres']);
    $this->start('main_content');
?>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
                <li class="active"> Liste de livres </li>
            </ol>
            <?php foreach($books as $book) : ?>
                <a href="<?php echo $this->url('public.view', ['id' => $book['id']]); ?>">
                    <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                        <div class="cover">
                            <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg';?>
                            <img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>">
                        </div>
                        <h3><?php echo $book['title'] ?></h3>
                        <h4><?php echo $book['author'] ?></h4>
                    </div>
                </a>
        <?php endforeach; ?>
        </div>
        <div class="row">
        <?php
            $previousPage = $page -1;
            $nextPage = $page +1;
        ?>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="<?php echo $this->url('public.book', ['page' => $previousPage]) ?>">Résultats précédents</a>
            <?php endif; ?>
            <?php if ($page < $nbpages) : ?>
                <a href="<?php echo $this->url('public.book', ['page' => $nextPage]) ?>">Résultats suivants</a>
            <?php endif; ?>
            <?php echo "<p>Page : ". $page."/".$nbpages."</p>"; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->stop('main_content') ?>