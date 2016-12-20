<?php
    $this->layout('layout', ['title' => 'Liste des livres']);
    $this->start('main_content');
?>

<div class="container-fluid">
    <div class="container">


        <div class="row">
            <ol class="breadcrumb">
                <li><a href="  <?php echo $this->url('home') ?>   ">Accueil</a></li>
                <li class="active"> Liste de livres</li>
            </ol>

            <?php if (isset($books)) : ?>
                <?php foreach ($books as $book) : ?>
                    <a href="<?php echo $this->url('public.view', ['id' => $book['id']]); ?>">
                        <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                            <div class="cover">
                                <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg'; ?>
                                <img src="<?php echo $this->assetUrl('../upload/cover') . "/" . $cover ?>"
                                     alt="cover de <?php echo $book['title'] ?>">
                            </div>
                            <h3><?php echo $book['title'] ?></h3>
                            <h4><?php echo $book['author'] ?></h4>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($books_reading_list as $book) : ?>
                    <a href="<?php echo $this->url('public.view', ['id' => $book['book_id']]); ?>">
                        <div class=" vignette col-xs-6 col-sm-4 col-md-2">
                            <div class="cover">
                                <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg'; ?>
                                <img src="<?php echo $this->assetUrl('../upload/cover') . "/" . $cover ?>"
                                     alt="cover de <?php echo $book['title'] ?>">
                            </div>
                            <h3><?php echo $book['title'] ?></h3>
                            <h4><?php echo $book['author'] ?></h4>

                            <?php if($w_user['id']==$book['user_id']) : ?>
                                <?php if (isset($book['read_status'])): ?>
                                    <?php if ($book['read_status'] == 1) : ?>
                                        <span class="label label-success">Lu</span>
                                    <?php else: ?>
                                        <span class="label label-danger">Non lu</span>
                                    <?php endif ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="row">
        <?php
            $previousPage = $page -1;
            $nextPage = $page +1;
        ?>
        <div class="pagination pager">
            <?php if ($page > 1) : ?>
                <li><a href="<?php echo $this->url('public.book', ['page' => $previousPage]) ?>">Résultats précédents</a></li>
            <?php endif; ?>
            <?php if ($page < $nbpages) : ?>
                <li><a href="<?php echo $this->url('public.book', ['page' => $nextPage]) ?>">Résultats suivants</a></li>
            <?php endif; ?>
            <?php echo "<p>Page : ". $page."/".$nbpages."</p>"; ?>
            </div>
        </div>
    </div>
</div>

<?php $this->stop('main_content') ?>