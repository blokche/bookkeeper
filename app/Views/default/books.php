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
                    <a class=" col-xs-6 col-sm-4 col-md-2 href="<?php echo $this->url('public.view', ['id' => $book['id']]); ?>">
                        <div class=" vignette">
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
                <?php
                $liste_book=[];
                $doublon=false;
                $label_user=false;
                $book_status;
                ?>
                <?php foreach ($books_reading_list as $book) : ?>
                    <?php foreach ($liste_book as $id_book) : ?>
                        <?php if ($book['book_id']==$id_book['book_id']) : ?>
                            <?php if ($book['user_id']==$w_user['id']) : ?>
                                <?php $label_user=true; ?>
                                <?php $book_status=$book; ?>
                                <?php $doublon =true; ?>
                            <?php else: ?>
                                <?php  $doublon=true; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php //var_dump($book); var_dump($liste_book); var_dump($doublon); ?>

                    <?php if (!$doublon) : ?>
                        <?php if (isset($book['book_id'])) : ?>
                            <?php $liste_book[]['book_id']=$book['book_id']; ?>

                            <a class="col-xs-6 col-sm-4 col-md-2" href="<?php echo $this->url('public.view', ['id' => $book['book_id']]); ?>">
                                <div class=" vignette ">
                                    <div class="cover">
                                        <?php $cover = (!empty($book['cover'])) ? $book['cover'] : 'default.jpg'; ?>
                                        <img src="<?php echo $this->assetUrl('../upload/cover') . "/" . $cover ?>"
                                             alt="cover de <?php echo $book['title'] ?>">
                                    </div>
                                    <?php if ($w_user['id']==$book['user_id']) : ?>
                                         <?php if (isset($book['read_status'])): ?>
                                            <?php //var_dump($book); ?>
                                            <?php if ($label_user) : ?>
                                                <?php if ($book_status['read_status'] == 1) : ?>
                                                    <span class="label label-success">Lu</span>
                                                <?php else: ?>
                                                    <span class="label label-danger">Non lu</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if ($book['read_status'] == 1) : ?>
                                                    <span class="label label-success">Lu</span>
                                                <?php else: ?>
                                                    <span class="label label-danger">Non lu</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                         <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="titre-auteur">
                                        <h3><?php echo $book['title'] ?></h3>
                                        <h4><?php echo $book['author'] ?></h4>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php $doublon=false; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php $previousPage = $page -1; ?>
            <?php $nextPage = $page +1; ?>
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