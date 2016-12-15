<?php $this->layout('layout', ['title' => 'Mes citations / extraits']) ?>

<?php $this->start('main_content') ?>

<?php if (count($quotes) > 0) : ?>
    <div class="quotes">

        <ul class="list">
            <?php foreach ($quotes as $quote) : ?>
                <li><?php echo $quote['content'] ?> <small>(<?php echo $quote['author'] ?>)</small> <a href="<?php echo $this->url('profile.quote.edit', ['id' => $quote['id']]) ?>">Éditer</a></li>
            <?php endforeach; ?>
        </ul>
        <a href="<?php echo $this->url('profile.quote.add'); ?>">Ajouter une citation, un extrait</a>
    </div>
<?php else : ?>
    <p>Aucune citation. <a href="<?php echo $this->url('profile.quote.add'); ?>">Ajoutez-en dès maintenant</a> !</p>
<?php endif; ?>

<?php $this->stop('main_content') ?>