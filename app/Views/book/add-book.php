<?php $this->layout('layout', ['title' => 'Ajouter un livre ']) ?>

    <pre>
<?php $this->start('main_content'); ?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb">
          <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
          <li><a href="<?php echo $this->url('profile.home') ?>">Mon profil</a></li>
          <li><a href="<?php echo $this->url('profile.quote',['page'=> 1]) ?>">Liste de lecture</a></li>
          <li class="active">Ajouter un citation/extrait</li>
        </ol>

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
    </div>
</div>


<?php $this->stop('main_content') ?>