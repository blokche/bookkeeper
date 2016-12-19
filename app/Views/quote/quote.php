<?php $this->layout('layout', ['title' => 'Mes citations / extraits']) ?>

<?php $this->start('main_content') ?>

<ol class="breadcrumb">
    <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
    <li><a href="<?php echo $this->url('profile.home') ?>">Mon profil</a></li>
    <li class="active">Mes citations / extraits</li>
</ol>

<?php if (count($quotes) > 0) : ?>
    <div class="container">
        <div class="form-group">
            <input style="margin-bottom:1em;margin-top:1em;" class="form-control search" placeholder="Rechercher..." />
            <button class="btn btn-default sort" data-sort="author">Trier par auteur</button>
            <button class="btn btn-default sort" data-sort="book">Trier par livre</button>
        </div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <th>Citation</th>
                    <th>Auteur</th>
                    <th>Livre associé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="list">
            <?php foreach ($quotes as $quote) : ?>
            <tr>
                <td class="content"><?php echo $quote['content']; ?></td>
                <td class="author"><?php echo $quote['quote_author']; ?></td>
                <td class="book"><?php echo (is_null($quote['title'])) ? '-' : $quote['title']; ?></td>
                <td><a class="btn" href="<?php echo $this->url('profile.quote.edit', ['id' => $quote['quote_id']]) ?>">Éditer</a></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="<?php echo $this->url('profile.quote.add'); ?>">Ajouter une citation, un extrait</a>

<?php else : ?>
    <p>Aucune citation. <a href="<?php echo $this->url('profile.quote.add'); ?>">Ajoutez-en dès maintenant</a> !</p>
<?php endif; ?>
    </div>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
<script src="<?php echo $this->assetUrl('vendor/list.js'); ?>"></script>
<script>
    var options = {
        valueNames: [ 'content', 'book', 'author' ]
    };

    var quotesList = new List('quotes', options);
</script>
<?php $this->stop('js') ?>
