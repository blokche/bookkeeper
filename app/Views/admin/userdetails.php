<?php $this->layout('admin', ['title' => 'User details']);

$this->start('main_content');?>
    <h2>User details</h2>
<?php if (count($users) > 0) : ?>
    <ul>
        <?php foreach($users as $user) : ?>
            <li><?php $user['username'] ;?> <a href="<?php echo $this->url('admin.user.edit', ['id' => $user['id']]) ?>" class="btn">Editer</a></li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Aucun utilisateur.</p>
<?php endif; ?>
<?php $this->stop('main_content') ?>