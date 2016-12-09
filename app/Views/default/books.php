<?php
    $this->layout('layout', ['title' => 'Accueil']);
    $this->start('main_content');
?>

<?php foreach($books as $book) : ?>
    <li><a href="<?php echo $this->url('public.view', ['id' => $book['id']]); ?>"><?php echo $book['title']; ?>, par <?php echo $book['author']; ?></a></li>
<?php endforeach; ?>

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

<?php $this->stop('main_content') ?>