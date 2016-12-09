<?php $this->layout('admin', ['title' => 'Book details']);

$this->start('main_content');?>
<h2>Book details</h2>
<?php if($book['cover'] !== NULL) : ; ?>
    <img src="<?php echo $book['cover'];?>" alt="<?php echo $book['title'];?>" />
<?php endif; ?>
<table>
    <tr>
        <th>Titre</th>
        <td><?php echo $book['title'] ?></td>
    </tr>
    <tr>
        <th>Auteur</th>
        <td><?php echo $book['author'] ?></td>
    </tr>
    <tr>
        <th>Statut</th>
        <td><?php echo $book['status'] == 1 ? "Actif" : "Inactif" ?></td>
    </tr>
</table>
<a href="<?php echo $this->url('admin.book.edit', ['id' => $book['id']]); ?>">Editer le livre</a>
<?php $this->stop('main_content') ?>