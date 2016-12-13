<?php

namespace Model;

use W\Model\Model;

class CategoryModel extends Model {

    public function __construct()
    {
        parent::__construct();
        $this->setTable("categories");
    }

}