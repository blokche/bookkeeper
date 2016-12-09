<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $this->e($title) ?> | Admin section</title>
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
</head>
<body>
<div class="container">
    <?php $this->insert('admin/menu') ;?>
    <section>
        <?= $this->section('main_content') ?>
    </section>
</div>
</body>
</html>