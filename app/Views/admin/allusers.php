<?php $this->layout('admin', ['title' => 'Utilisateurs']);

$this->start('main_content');?>
<header class="site-header">
    <h1><i class="fa fa-user-circle" aria-hidden="true"></i> Utilisateurs</h1>
</header>
<div class="row">
<div class="col-sm-12">
        <?php if (count($users) > 0) : ?>
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pseudonyme</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php foreach($users as $user) : ?>
                    <tr>
                        <td><?php echo $user['id'] ;?></td>
                        <td><?php echo $user['username'] ;?></td>
                        <td>
                            <a class="btn btn-default" href="<?php echo $this->url("admin.user.view", ['id' => $user['id']]); ?>">Consulter</a>
                            <a class="btn btn-default" href="<?php echo $this->url('admin.user.edit', ['id' => $user['id']]) ?>" class="btn">Editer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>Aucun utilisateur.</p>
        <?php endif; ?>
    </div>
</div>
<?php $this->stop('main_content') ?>
