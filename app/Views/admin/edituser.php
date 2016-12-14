<?php $this->layout('admin', ['title' => 'Editer l\'utilisateur']);

$this->start('main_content');?>
    <form action="<?php echo $this->url('admin.user.delete', ['id' => $user['id']]); ?>" method="POST">
        <input class="btn btn-danger btn-sm" type="submit" name="deleteuser" value="Supprimer l'utilisateur &laquo; <?php echo $user['username']; ?> &raquo;">
    </form>
    <header class="site-header">
        <h1>Éditer l'utilisateur #<?php echo $user['id']; ?></h1>
    </header>
    <div class="row">
        <div class="col-sm-12">
            <form class="form" action="<?php echo $this->url('admin.user.edit', ['id' => $user['id']]); ?>" method="POST">
                <div class="form-group">
                    <p>Droits associés au compte</p>
                    <input type="radio" name="role" value="admin" id="admin" <?php echo ($user['role'] == 'admin' ? 'checked' : null) ?>><label for="admin">Admin</label>
                    <input type="radio" name="role" value="user" id="user" <?php echo ($user['role'] == 'user' ? 'checked' : null) ?>><label for="user">Utilisateur</label>
                </div>
                <div class="form-group">
                    <p>Status de l'utilisateur</p>
                    <input id="active" type="checkbox" name="active" <?php echo ($user['status'] == 1) ? 'checked' : null ;?>>
                    <label for="active">Actif ?</label>
                </div>
                <a href="<?php echo $this->url("admin.user.view", ['id' => $user['id']]); ?>" class="btn btn-default">Retour au profil de l'utilisateur</a>
                <input name="edit" class="btn btn-success" type="submit" value="Enregistrer les modifications">
            </form>
        </div>
    </div>
<?php $this->stop('main_content') ?>