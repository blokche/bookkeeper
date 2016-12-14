<?php $this->layout('layout', ['title' => 'Profile de '.$w_user['username']]) ?>

<?php $this->start('main_content') ?>

<img src="<?php echo $this->assetUrl('../upload/avatar')."/".$avatar ?>" alt="avatar">
<div><p>Email : <?php echo $w_user['email'] ?></p></div>
<div><p>Compte créé le : <?php echo $w_user['created_at'] ?></p></div>

<div><a href="<?php echo $this->url('profile.edit') ?>">Modifier son profil</a></div>

<p>Liste des livres lu:</p>
<ul>
<?php
foreach ($bookRead as $book){ ?>
    <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg';?>
        <li><img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>"> <?php echo $book['title'] ?> <?php echo $book['author'] ?></li>
<?php } ?>
</ul>

<p>Liste des livres à lire:</p>
<ul>
    <?php
    foreach ($bookNoRead as $book){ ?>
        <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg';?>
        <li><img src="<?php echo $this->assetUrl('../upload/cover')."/".$cover ?>" alt="cover de <?php echo $book['title'] ?>"> <?php echo $book['title'] ?> <?php echo $book['author'] ?></li>
    <?php } ?>
</ul>


<?php $this->stop('main_content') ?>
