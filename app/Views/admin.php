<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $this->e($title) ?> | Admin section</title>
    <link rel="favicon" href="favicon.ico">
    <link rel="stylesheet" href="<?= $this->assetUrl('vendor/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="<?= $this->assetUrl('vendor/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= $this->assetUrl('css/admin.css') ?>">
</head>
<body>
    <div class="container-fluid">
        <?php $this->insert('admin/menu') ;?>
    </div>
    <div class="container">
        <?php if ( isset($_SESSION['message']['type']) ) : ?>
            <div class="row">
                <div class="col-sm-12">
                    <p class="alert alert-<?php echo $_SESSION['message']['type'] ?>"><?php echo $_SESSION['message']['message']; ?></p>
                </div>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <?= $this->section('main_content') ?>
    </div>
    <script src="<?php echo $this->assetUrl('vendor/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo $this->assetUrl('vendor/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
    <?php echo $this->section('js') ?>
</body>
</html>