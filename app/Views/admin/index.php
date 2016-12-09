<?php $this->layout('admin', ['title' => 'Admin section']);

$this->start('main_content');?>
<h1>Admin index</h1>
<h3>Users : <?php echo $totalUsers; ?></h3>
<h3>Quotes : <?php echo $totalQuotes; ?></h3>
<h3>Books : <?php echo $totalBooks; ?></h3>
<?php $this->stop('main_content') ?>
