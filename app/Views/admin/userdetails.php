<?php $this->layout('admin', ['title' => 'Détails utilisateur']);

$this->start('main_content');?>
    <header class="site-header">
        <h1>Utilisateur #<?php echo $user['id'] ?></h1>
    </header>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-responsive">
                <tr>
                    <th>#</th>
                    <td><?php echo $user['id']; ?></td>
                </tr>
                <tr>
                    <th>Pseudonyme</th>
                    <td><?php echo $user['username']; ?></td>
                </tr>
                <tr>
                    <th>Adresse électronique</th>
                    <td><?php echo $user['email']; ?></td>
                </tr>
                <tr>
                    <th>Droits</th>
                    <td><?php echo $user['role']; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo $user['status'] ? "Actif" : "Inactif"; ?></td>
                </tr>
            </table>
            <a class="btn btn-default" href="<?php echo $this->url('admin.user.edit', ['id' => $user['id']]) ?>" class="btn btn-default">Éditer l'utilisateur</a>
        </div>
    </div>
<?php $this->stop('main_content') ?>