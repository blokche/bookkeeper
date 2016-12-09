<?php $this->layout('layout', ['title' => 'Forget Password']) ?>

<?php $this->start('main_content') ?>
    <h1></h1>
    <form action="<?= $this->url('auth.forgetpassword') ?>" method="POST">
        <div class="form-group">
            <label for="email">Email :</label>
            <input id="email" name="email" type="text" class="form-control">
        </div>

        <button name="forget-password" class="btn btn-default">Récupérer mon mot de passe</button>
    </form>
<?php $this->stop('main_content') ?>