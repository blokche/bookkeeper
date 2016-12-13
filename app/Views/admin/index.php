<?php $this->layout('admin', ['title' => 'Admin section']);

$this->start('main_content');?>
<header class="site-header">
    <h1>Bienvenue <span class="username"><?php echo $w_user['username']; ?> !</span></h1>
    <p>Content de vous voir !</p>
</header>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="well">
            <h2>Statistiques</h2>
            <h3>Utilisateurs</h3>
            <p><?php echo $totalUsers; ?> utilisateur(s) enregistré(s).</p>
            <h3>Citations / extraits</h3>
            <p><?php echo $totalQuotes; ?> citations / extraits</p>
            <h3>Livres</h3>
            <p><?php echo $totalBooks; ?> livre(s)</p>
        </div>
    </div>
</div>

<?php $this->stop('main_content') ?>
