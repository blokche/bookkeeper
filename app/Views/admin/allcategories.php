<?php $this->layout('admin', ['title' => 'Catégories']); ?>
<?php $this->start('main_content') ?>
    <header class="site-header">
        <h1><i class="fa fa-tags" aria-hidden="true"></i> Catégories</h1>
    </header>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-responsive table-striped">
                <tr>
                    <th>#</th>
                    <th>Label</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo $category['label']; ?></td>
                    <td><a class="btn btn-default" href="<?php echo $this->url('category.edit', ['id' => $category['id']]); ?>">Éditer</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
<?php $this->stop('main_content') ?>
