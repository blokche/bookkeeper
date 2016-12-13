<?php $this->layout('layout', ['title' => 'Liste des citations']) ?>

<?php $this->start('main_content') ?>

<pre>

<?= var_dump($quotes) ?>

</pre>

<?php $this->stop('main_content') ?>