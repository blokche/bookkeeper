<?php $this->layout('layout', ['title' => 'Modifier un profile']) ?>

<?php $this->start('main_content') ?>

    <form action="<?php $this->url('profile.edit') ?>" method="POST" enctype="multipart/form-data">
        <div class=" form-group">
            <label for="email">Modifier l'email :</label>
            <input value="<?= $w_user['email'] ?>" id="email" name="email" class="form-control" type="text">
        </div>
        <div class=" form-group">
            <label for="username">Modifier le Pseudo :</label>
            <input value="<?= $w_user['username'] ?>" id="username" name="username" class="form-control" type="text">
        </div>
        <div class=" form-group">
            <label for="avatar">Modifier l'avatar :</label>
            <input id="avatar" name="avatar" class="form-control" type="file">
        </div>
        <div class="form-group">
            <label for="password">Password :</label>
            <input id="password" name="password" class="form-control" type="password">
        </div>
        <div class="form-group">
            <label for="newPassword">Nouveau password :</label>
            <input id="newPassword" name="newPassword" class="form-control" type="password">
        </div>
        <div class="form-group">
            <label for="newPassword-cf">Confirmer le nouveau password :</label>
            <input id="newPassword-cf" name="newPassword-cf" class="form-control" type="password">
        </div>
        <button name="editUsers" class="btn btn-default">Modifier mon profil</button>
    </form>

<?php foreach ($message as $error){ ?>
    <ul>
        <li><?= $error ?></li>
    </ul>
<?php } ?>

<div><a href="<?php echo $this->url('profile.home') ?>">Retour au profil</a></div>

<?php $this->stop('main_content') ?>