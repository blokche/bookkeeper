<?php $this->layout('layout', ['title' => 'Ajouter un livre ']) ?>

    <pre>
<?php $this->start('main_content'); ?>

<form action="<?php $this->url('profile.book.add') ?>" method="POST" enctype="multipart/form-data">

    <div class=" form-group">
        <label for="title">Titre :</label>
        <input id="title" name="title" class="form-control" type="text" required>
    </div>


    <div class=" form-group">
        <label for="author">Auteur :</label>
        <input id="author" name="author" class="form-control" type="text" required>
    </div>


    <div class=" form-group">
        <label for="cover">Couverture :</label>
        <input id="cover" name="cover" class="form-control" type="file">
    </div>

    <div class="radio">
        <label>
            <input type="radio" name="optionsRadios" id="status-non-lu" value="0">
            Ajouter ce livre dans ma liste de lecture en tant que livre non lu
        </label>
        <label>
            <input type="radio" name="optionsRadios" id="status-lu" value="1">
            Ajouter ce livre dans ma liste de lecture en tant que livre lu
        </label>
    </div>


    <button name="addBook" class="btn btn-default">Ajouter un livre</button>
</form>

<?php if(isset($_SESSION['message'])):?>
 <?php  foreach ($_SESSION['message'] as $message) : ?>
    <p class="<?php echo $message['type'] ?> "> <?php echo $message['message'] ?></p>
    <?php endforeach; ?>
<?php unset($_SESSION['message']) ?>
<?php endif; ?>

<?php $this->stop('main_content') ?>