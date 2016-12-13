<?php

namespace Model;

use W\Model\Model;

class QuoteModel extends Model {

    public function __construct()
    {
        parent::__construct();
        $this->setTable("quotes");
    }

}