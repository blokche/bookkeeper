<?php
    $this->layout('layout', ['title' => 'Accueil']);
    $this->start('main_content');
?>

<?php foreach($books as $book) : ?>
    <li><a href="<?php echo $this->url('public.view', ['id' => $book['id']]); ?>"><?php echo $book['title']; ?>, par <?php echo $book['author']; ?></a></li>
<?php endforeach; ?>

<?php $this->stop('main_content') ?>