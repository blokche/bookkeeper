<?php $this->layout('layout', ['title' => 'Liste de lecture']) ?>

<?php $this->start('main_content') ?>


<form action="<?php $this->url('profile.book.add') ?>" method="POST" >

    <div class=" form-group">
        <label for="title">Titre :</label>
        <input id="title" name="title" class="form-control" type="text">
    </div>


    <div class=" form-group">
        <label for="cover">Auteur :</label>
        <input id="cover" name="cover" class="form-control" type="text">
    </div>


    <div class=" form-group">
        <label for="author">Couverture :</label>
        <input id="author" name="author" class="form-control" type="text">
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



<?php $this->stop('main_content') ?>