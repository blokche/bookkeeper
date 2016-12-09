<?php $this->layout('admin', ['title' => 'Books']);

$this->start('main_content');?>
<h1>Books</h1>
<?php if (count($books) > 0) : ?>
    <ul>
        <?php foreach($books as $book) : ?>
            <li><?php echo $book['title'] ;?> (<small><?php echo $book['author']; ?></small>) <br /><a href="<?php echo $this->url('admin.book.view', ['id' => $book['id']]) ?>" class="btn">Consulter</a> <a href="<?php echo $this->url('admin.book.edit', ['id' => $book['id']]) ?>" class="btn">Editer</a></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun utilisateur.</p>
<?php endif; ?>
<?php $this->stop('main_content') ?>
