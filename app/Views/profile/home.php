<?php $this->layout('layout', ['title' => 'Profile de '.$w_user['username']]) ?>

<?php $this->start('main_content') ?>
<div class="background-profil">
    <div class="container">
        <div class="row profil">
            <div class=" col-xs-6 col-md-2">
                <img src="<?php echo $this->assetUrl('../upload/avatar')."/".$avatar ?>" alt="avatar">
            </div>
            <div class=" col-xs-12 col-md-6">
                <p><span class="gras">Pseudo :</span> <?php echo $w_user['username'] ?></p>
                <p><span class="gras">Email :</span> <?php echo $w_user['email'] ?></p>
                <p><span class="gras">Compte créé le :</span> <?php echo $w_user['created_at'] ?></p>
                <a href="<?php echo $this->url('profile.edit') ?>">Modifier son profil</a>
            </div>
        </div>

        <div class="titre-liste row">
            <h1>Liste des livres lus:</h1>
        </div>

        <div class="row">
        <?php
        foreach ($bookRead as $book){ ?>
                <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                    <div class="cover">
                        <img src="<?php echo $book['cover'] ?>" alt="cover de <?php echo $book['title'] ?>">
                    </div>
                    <h1><?php echo $book['title'] ?></h1>
                    <h2><?php echo $book['author'] ?></h2>
                </div>
        <?php } ?>
        </div>



        <div class="titre-liste row">
            <h1>Liste des livres à lire:</h1>
        </div>

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


        <div class="row">
            <?php
            foreach ($bookNoRead as $book){ ?>
                <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                    <div class="cover">
                        <img src="<?php echo $book['cover'] ?>" alt="cover de <?php echo $book['title'] ?>">
                    </div>
                    <h1><?php echo $book['title'] ?></h1>
                    <h2><?php echo $book['author'] ?></h2>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php $this->stop('main_content') ?>
