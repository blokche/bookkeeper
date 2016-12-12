<?php $this->layout('admin', ['title' => 'Catégories']); ?>
<?php $this->start('main_content') ?>
    <h1>Catégories</h1>
    <ul>
    <?php foreach ($categories as $category) : ?>
        <li><?php echo $category['label']; ?> <a href="<?php echo $this->url('category.edit', ['id' => $category['id']]); ?>">Éditer</a></li>
    <?php endforeach; ?>
    </ul>
<?php $this->stop('main_content') ?>
