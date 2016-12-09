<?php

$this->layout('layout', ['title' => $book['title']]) ;

$this->start('main_content');

var_dump($book);

$this->stop('main_content') ?>
