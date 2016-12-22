<?php $this->layout('layout', ['title' => 'Ajouter un livre ']) ?>

    <pre>
<?php $this->start('main_content'); ?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb">
          <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
          <li><a href="<?php echo $this->url('public.book',['page'=> 1]) ?>">Liste des livres</a></li>
          <li class="active">Ajouter un livre</li>
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
                <small>Extensions autorisées : .jpg, .jpeg, .png, .gif</small>
                <input id="cover" name="cover" class="" type="file">
            </div>

            <div class="radio">
                <p>Ajouter ce livre dans ma liste de lecture en tant que livre :</p>
                <label>
                    <input type="radio" name="optionsRadios" id="status-non-lu" value="0">
                     non lu
                </label>
                <br>
                <label>
                    <input type="radio" name="optionsRadios" id="status-lu" value="1">
                     lu
                </label>
            </div>
            <a class="btn btn-primary pull-left " href="  <?php echo $this->url('public.book',['page' => 1]) ?>   " >Revenir à la liste des livres</a>
            <button name="addBook" class="btn btn-success pull-right">Ajouter un livre</button>
        </form>
    </div>
</div>


<?php $this->stop('main_content') ?>