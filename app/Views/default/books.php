<?php
    $this->layout('layout', ['title' => 'Liste des livres']);
    $this->start('main_content');
?>

<div class="container-fluid">
    <div class="container">


        <div class="row ">
            <ol class="breadcrumb">
                <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
                <li class="active"> Liste de livres</li>
            </ol>
        </div>
        <div class="row booklist">
            <?php if (isset($books)) : ?>
                <?php foreach ($books as $book) : ?>
                    <a class=" col-xs-6 col-sm-4 col-md-2" href="<?php echo $this->url('public.view', ['id' => $book['id']]); ?>">
                        <div class=" vignette">
                            <div class="cover">
                                <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg'; ?>
                                <img src="<?php echo $this->assetUrl('../upload/cover') . "/" . $cover ?>"
                                     alt="cover de <?php echo $book['title'] ?>">
                            </div>
                            
                            <?php if ($w_user) : ?>
                                <?php $status=$user_model->getFromReadingListByBookId($book['id'],$w_user); ?>
                                <?php if ($status): ?>
                                    <?php if ($status['read_status'] == 1) : ?>
                                        <span class="label label-success">Lu</span>
                                    <?php else: ?>
                                        <span class="label label-danger">Non lu</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <h3><?php echo $book['title'] ?></h3>
                            <h4><?php echo $book['author'] ?></h4>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Aucun livre n'est present.</p>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php $previousPage = $page -1; ?>
            <?php $nextPage = $page +1; ?>
            <?php if ($page > 1) : ?>
                <a class="pull-left btn-info btn-primary btn" href="<?php echo $this->url('public.book', ['page' => $previousPage]) ?>">Résultats précédents</a></li>
            <?php endif; ?>
            <?php if ($page < $nbpages) : ?>
                <a class="pull-right btn-primary btn" href="<?php echo $this->url('public.book', ['page' => $nextPage]) ?>">Résultats suivants</a></li>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php echo "<p class='text-center' >Page : ". $page."/".$nbpages."</p>"; ?>
        </div>
    </div>
</div>

<?php $this->stop('main_content') ?>