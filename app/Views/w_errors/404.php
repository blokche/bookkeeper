<?php $this->layout('layout', ['title' => 'Perdu ?']) ?>

<?php $this->start('main_content'); ?>
<h1>404.</h1>
<h2>Perdu ? Besoin de Lunettes ?</h2>
<img src="<?= $this->assetUrl('img/logoLunettes.svg')?>" alt="">
<?php $this->stop('main_content'); ?>
